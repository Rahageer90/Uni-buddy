<?php

namespace App\Http\Controllers;

use App\Models\HousingPost;
use App\Models\HousingPhoto;
use App\Models\RoommatePreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HousingPostController extends Controller
{
    /**
     * Display a listing of housing posts.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'min_price', 'max_price', 'property_type', 'bedrooms',
            'bathrooms', 'location', 'available_from', 'utilities_included'
        ]);
        
        $posts = HousingPost::with(['user', 'photos' => function($query) {
            $query->where('is_primary', true);
        }])
        ->filter($filters)
        ->available()
        ->latest()
        ->paginate(10);
        
        return view('housing.index', [
            'posts' => $posts,
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new housing post.
     */
    public function create()
    {
        return view('housing.create');
    }

    /**
     * Store a newly created housing post.
     */
    public function store(Request $request)
    {
        // Debug the incoming request
        Log::info('Housing Post Store Request: ' . json_encode($request->all()));
        
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'rent_amount' => 'required|numeric|min:0',
                'bedrooms' => 'required|integer|min:0',
                'bathrooms' => 'required|numeric|min:0',
                'description' => 'required|string',
                'contact_phone' => 'nullable|string|max:20',
                'property_type' => 'required|string|max:50',
                'utilities_included' => 'boolean',
                'available_from' => 'required|date',
                'photos' => 'nullable|array|max:10',
                'photos.*' => 'image|max:5120', // 5MB per image
            ]);
            
            // Debug validation success
            Log::info('Validation passed. Preparing to save housing post.');
            
            // Set default values
            $validated['user_id'] = Auth::id();
            $validated['is_available'] = true;
            $validated['utilities_included'] = isset($validated['utilities_included']);
            
            // Debug the data being saved
            Log::info('Saving post with data: ' . json_encode($validated));
            
            // Create the housing post
            $post = HousingPost::create($validated);
            
            // Debug successful creation
            Log::info('Housing post created successfully with ID: ' . $post->id);
            
            // Handle photo uploads
            if ($request->hasFile('photos')) {
                Log::info('Processing ' . count($request->file('photos')) . ' photos.');
                $this->handlePhotoUploads($request->file('photos'), $post);
            } else {
                Log::info('No photos to upload.');
            }
            
            return redirect()->route('housing.my-posts')
                ->with('success', 'Housing listing created successfully.');
                
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error creating housing post: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return back()->withInput()->with('error', 'There was a problem creating your housing post: ' . $e->getMessage());
        }
    }

    /**
     * Display a specific housing post.
     */
    public function show($id)
    {
        $housingPost = HousingPost::with(['user', 'photos', 'approvedReviews.user'])
            ->findOrFail($id);
            
        // Check if current user has already reviewed this property
        $userHasReviewed = false;
        
        if (Auth::check()) {
            $userHasReviewed = $housingPost->reviews()
                ->where('user_id', Auth::id())
                ->exists();
        }
        
        return view('housing.show', [
            'housingPost' => $housingPost,
            'userHasReviewed' => $userHasReviewed
        ]);
    }

    /**
     * Show the form for editing a housing post.
     */
    public function edit($id)
    {
        $housingPost = HousingPost::with('photos')->findOrFail($id);
        
        // Check if current user owns this post
        if ($housingPost->user_id !== Auth::id()) {
            abort(403, 'You cannot edit someone else\'s housing post.');
        }
        
        return view('housing.edit', [
            'housingPost' => $housingPost
        ]);
    }

    /**
     * Update a housing post.
     */
    public function update(Request $request, $id)
    {
        $post = HousingPost::findOrFail($id);
        
        // Check if current user owns this post
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You cannot edit someone else\'s housing post.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'rent_amount' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|numeric|min:0',
            'description' => 'required|string',
            'contact_phone' => 'nullable|string|max:20',
            'property_type' => 'required|string|max:50',
            'utilities_included' => 'boolean',
            'available_from' => 'required|date',
            'is_available' => 'boolean',
            'photos' => 'nullable|array|max:10',
            'photos.*' => 'image|max:5120', // 5MB per image
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer|exists:housing_photos,id',
        ]);
        
        // Update boolean fields
        $validated['utilities_included'] = isset($validated['utilities_included']);
        $validated['is_available'] = isset($validated['is_available']);
        
        // Update the housing post
        $post->update($validated);
        
        // Delete photos if requested
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = HousingPhoto::find($photoId);
                if ($photo && $photo->housing_post_id == $post->id) {
                    $photo->delete(); // This will also delete the file from storage
                }
            }
        }
        
        // Handle new photo uploads
        if ($request->hasFile('photos')) {
            $this->handlePhotoUploads($request->file('photos'), $post);
        }
        
        return redirect()->route('housing.my-posts')
            ->with('success', 'Housing listing updated successfully.');
    }

    /**
     * Remove a housing post.
     */
    public function destroy($id)
    {
        $post = HousingPost::findOrFail($id);
        
        // Check if current user owns this post
        if ($post->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'You cannot delete someone else\'s housing post.');
        }
        
        // Delete the post (photos will be deleted via the model's boot method)
        $post->delete();
        
        return redirect()->route('housing.my-posts')
            ->with('success', 'Housing listing deleted successfully.');
    }

    /**
     * Display user's own housing posts.
     */
    public function myHousingPosts()
    {
        $posts = HousingPost::with(['photos' => function($query) {
            $query->where('is_primary', true);
        }])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
        
        // Count statistics
        $statistics = [
            'total' => $posts->count(),
            'available' => $posts->where('is_available', true)->count(),
            'unavailable' => $posts->where('is_available', false)->count(),
        ];
        
        return view('housing.my-posts', [
            'posts' => $posts,
            'statistics' => $statistics
        ]);
    }

    /**
     * Find matching housing based on user preferences.
     */
    public function findMatches()
    {
        $userId = Auth::id();
        $matches = HousingPost::findMatchingHousing($userId);
        
        return view('housing.matches', [
            'matches' => $matches
        ]);
    }

    /**
     * Toggle the availability status of a housing post.
     */
    public function toggleStatus($id)
    {
        $post = HousingPost::findOrFail($id);
        
        // Check if current user owns this post
        if ($post->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot modify someone else\'s housing post.'
            ], 403);
        }
        
        // Toggle the status
        $post->is_available = !$post->is_available;
        $post->save();
        
        return response()->json([
            'success' => true,
            'is_available' => $post->is_available,
            'message' => $post->is_available ? 'Post marked as available.' : 'Post marked as not available.'
        ]);
    }

    /**
     * Handle uploading and storing photos for housing posts.
     */
    private function handlePhotoUploads($files, $housingPost)
    {
        $counter = 0;
        foreach ($files as $file) {
            // Generate unique filename
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Store file in storage
            $path = $file->storeAs(
                'housing_photos/' . $housingPost->id,
                $filename,
                'public'
            );
            
            // Create photo record
            $photo = new HousingPhoto([
                'housing_post_id' => $housingPost->id,
                'file_path' => 'public/' . $path,
                'file_name' => $file->getClientOriginalName(),
                'caption' => null,
                'is_primary' => ($counter === 0), // First photo is primary
                'sort_order' => $counter,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
            
            $photo->save();
            $counter++;
        }
    }
}
