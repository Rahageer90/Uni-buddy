<?php
namespace App\Http\Controllers;

use App\Models\ThesisPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThesisPostController extends Controller
{
    public function index()
    {
        $posts = ThesisPost::with('user')->latest()->get();
        return view('thesis.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('thesis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'thesis_topic' => 'nullable',
            'thesis_field' => 'required',
            'details' => 'required'
        ]);

        ThesisPost::create([
            'posted_by' => Session::get('user_id'),
            'department' => $request->department,
            'thesis_topic' => $request->thesis_topic,
            'thesis_field' => $request->thesis_field,
            'details' => $request->details
        ]);

        return redirect('/thesis')->with('success', 'Post created!');
    }

    public function myPosts()
    {
        $userId = Session::get('user_id');
        $posts = ThesisPost::where('posted_by', $userId)->with('requests')->get();
        return view('thesis.my-posts', ['posts' => $posts]);
    }

    public function edit($id)
    {
        $post = ThesisPost::findOrFail($id);

        if ($post->posted_by !== Session::get('user_id')) {
            abort(403);
        }

        return view('thesis.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = ThesisPost::findOrFail($id);

        if ($post->posted_by !== Session::get('user_id')) {
            abort(403);
        }

        $post->update([
            'department' => $request->department,
            'thesis_topic' => $request->thesis_topic,
            'thesis_field' => $request->thesis_field,
            'details' => $request->details
        ]);

        return redirect('/thesis/my-posts')->with('success', 'Post updated.');
    }

    public function destroy($id)
    {
        $post = ThesisPost::findOrFail($id);

        if ($post->posted_by !== Session::get('user_id')) {
            abort(403);
        }

        $post->delete();

        return redirect('/thesis/my-posts')->with('success', 'Post deleted.');
    }
}
