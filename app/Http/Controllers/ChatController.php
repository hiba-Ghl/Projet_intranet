<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        // Fetch all discussions with their messages
        $discussions = Discussion::with('messages')->get();
        
        // Return the view with the discussions data
        return view('chat', compact('discussions'));
    }

    public function getMessages($discussionId)
{
    // Retrieve the discussion and its related messages
    $discussion = Discussion::with('messages')->find($discussionId);

    if (!$discussion) {
        return response()->json(['error' => 'Discussion not found'], 404);
    }

    // Return the messages and the title of the discussion
    return response()->json([
        'titre' => $discussion->titre,
        'messages' => $discussion->messages->map(function ($message) {
            return [
                'contenu' => $message->contenu,
                'created_at' => $message->created_at->format('h:i A'),
            ];
        }),
    ]);
}

    

   // Send a new message to a discussion
public function sendMessage(Request $request, $discussionId)
{
    $discussion = Discussion::find($discussionId);

    if (!$discussion) {
        return response()->json(['error' => 'Discussion not found'], 404);
    }

    $request->validate([
        'contenu' => 'required|string|max:255',
    ]);

    // Save the new message
    $message = new Message();
    $message->contenu = $request->contenu;
    $message->IDdiscussion = $discussionId;  // Corrected to use IDdiscussion
    $message->auteur = auth()->id();  // Assuming the user is logged in
    $message->save();

    // Return the saved message in the correct format
    return response()->json([
        'success' => true,
        'message' => [
            'contenu' => $message->contenu,
            'created_at' => $message->created_at->format('h:i A'),
        ]
    ]);
}
}
