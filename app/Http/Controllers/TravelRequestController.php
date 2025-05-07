<?php

namespace App\Http\Controllers;

use App\Models\TravelRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TravelRequestMail;

class TravelRequestController extends Controller
{
    public function index()
    {
        $sentRequests = TravelRequest::with(['receiver', 'schedule'])
            ->where('sender_id', Auth::id())
            ->get();

        $receivedRequests = TravelRequest::with(['sender', 'schedule'])
            ->where('receiver_id', Auth::id())
            ->get();

        return view('requests.index', compact('sentRequests', 'receivedRequests'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,studentID',
            'schedule_id' => 'required|exists:returnSchedule,id',
            'message' => 'nullable|string',
        ]);

        // Check if request already exists
        $existingRequest = TravelRequest::where('sender_id', Auth::id())
            ->where('receiver_id', $validated['receiver_id'])
            ->where('travel_schedule_id', $validated['schedule_id'])
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'You have already sent a request to this user.');
        }

        $travelRequest = TravelRequest::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'travel_schedule_id' => $validated['schedule_id'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        // Create notification
        Notification::create([
            'user_id' => $validated['receiver_id'],
            'message' => 'You have a new travel request from ' . Auth::user()->name,
        ]);

        // Send email notification
        $receiver = User::find($validated['receiver_id']);
        Mail::to($receiver->email)->send(new TravelRequestMail(Auth::user(), $receiver));

        return back()->with('success', 'Travel request sent successfully.');
    }

    public function respond(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
            'message' => 'nullable|string',
        ]);

        $travelRequest = TravelRequest::where('id', $id)
            ->where('receiver_id', Auth::id())
            ->firstOrFail();

        $travelRequest->update([
            'status' => $validated['status'],
            'is_read' => false,
        ]);

        // Create notification
        Notification::create([
            'user_id' => $travelRequest->sender_id,
            'message' => 'Your travel request to ' . Auth::user()->name . ' has been ' . $validated['status'],
        ]);

        return back()->with('success', 'Response sent successfully.');
    }
}
