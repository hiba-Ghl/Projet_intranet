<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Apply middleware to all controller actions.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            // Fetch all discussions with their messages
            $discussions = Discussion::with(['messages' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])->get();
            
            // Log the number of discussions found
            Log::info('Number of discussions found: ' . $discussions->count());
            
            // Return the view with the discussions data
            return view('chat', compact('discussions'));
        } catch (\Exception $e) {
            Log::error('Error in ChatController@index: ' . $e->getMessage());
            return view('chat', ['discussions' => collect([])]);
        }
    }

    public function getMessages($discussionId)
    {
        try {
            // Log the discussion ID being requested
            Log::info('Fetching messages for discussion ID: ' . $discussionId);
            
            // Retrieve the discussion and its related messages
            $discussion = Discussion::with(['messages' => function($query) {
                $query->orderBy('created_at', 'asc');
            }])->find($discussionId);

            if (!$discussion) {
                Log::warning('Discussion not found with ID: ' . $discussionId);
                return response()->json(['error' => 'Discussion not found'], 404);
            }

            // Log the number of messages found
            Log::info('Number of messages found: ' . $discussion->messages->count());

            // Return the messages and the title of the discussion
            return response()->json([
                'titre' => $discussion->titre,
                'messages' => $discussion->messages->map(function ($message) {
                    return [
                        'contenu' => $message->contenu,
                        'created_at' => $message->created_at->format('h:i A'),
                        'auteur' => $message->auteur,
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ChatController@getMessages: ' . $e->getMessage());
            return response()->json(['error' => 'Error retrieving messages'], 500);
        }
    }

    public function sendMessage(Request $request, $discussionId)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $discussion = Discussion::find($discussionId);

            if (!$discussion) {
                Log::warning('Discussion not found for sending message: ' . $discussionId);
                return response()->json(['error' => 'Discussion not found'], 404);
            }

            $request->validate([
                'contenu' => 'required|string|max:255',
            ]);

            // Save the new message
            $message = new Message();
            $message->contenu = $request->contenu;
            $message->IDdiscussion = $discussionId;
            $message->auteur = Auth::id();
            $message->date_envoi = now();
            $message->save();

            Log::info('New message saved with ID: ' . $message->IDmessage);

            // Return the saved message in the correct format
            return response()->json([
                'success' => true,
                'message' => [
                    'contenu' => $message->contenu,
                    'created_at' => $message->created_at->format('h:i A'),
                    'auteur' => $message->auteur,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ChatController@sendMessage: ' . $e->getMessage());
            return response()->json(['error' => 'Error sending message'], 500);
        }
    }
}
