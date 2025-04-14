<?php
namespace App\Http\Controllers;

use App\Models\ThesisPost;
use App\Models\ThesisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThesisRequestController extends Controller
{
    public function sendRequest(Request $request, $id)
    {
        $post = ThesisPost::findOrFail($id);

        if ($post->posted_by == Session::get('user_id')) {
            return redirect()->back()->with('error', 'You cannot send request to your own post.');
        }

        $request->validate([
            'message' => 'required'
        ]);

        ThesisRequest::create([
            'post_id' => $id,
            'sent_by' => Session::get('user_id'),
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Request sent.');
    }

    public function myReceivedRequests()
    {
        $userId = Session::get('user_id');

        // Get all requests for posts created by current user
        $requests = ThesisRequest::whereHas('post', function ($q) use ($userId) {
            $q->where('posted_by', $userId);
        })->with(['post', 'sender'])->get();

        return view('thesis.requests', ['requests' => $requests]);
    }
}
