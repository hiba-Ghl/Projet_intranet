<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Store a new message in a specific discussion
    public function store(Request $request, $discussionId)
    {
        // Validate the incoming message content
        $validated = $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        // Find the discussion by ID
        $discussion = Discussion::find($discussionId);

        if (!$discussion) {
            return response()->json(['error' => 'Discussion not found'], 404);
        }

        // Create a new message for the discussion
        $message = new Message([
            'contenu' => $validated['contenu'],
            'auteur' => auth()->user()->IDUtilisateur, // Assume the message is sent by the currently authenticated user
            'IDdiscussion' => $discussion->IDdiscussion,
        ]);

        // Save the message
        $message->save();

        // Return a success response with the newly created message
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    // Optionally, you can add other methods here, such as deleting a message, updating a message, etc.
}
