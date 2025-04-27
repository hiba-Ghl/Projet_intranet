@extends('layouts.app')

@section('content')
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-1/4 border-r p-4 bg-white">
        <div class="text-xl font-bold mb-4">Chats</div>
        <input type="text" placeholder="Search For Contacts or Messages"
               class="w-full p-2 mb-4 border rounded">

        <div>
            <div class="font-semibold mb-2">Recent Chats</div>
            <div class="space-y-4">
            @foreach ($discussions as $discussion)
    <div class="flex items-center justify-between cursor-pointer" onclick="loadDiscussionMessages({{ $discussion->IDdiscussion }})">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-yellow-200 rounded-full"></div>
            <div>
                <div class="font-medium">{{ $discussion->titre }}</div>
                <div class="text-xs text-gray-500">
                    Last message: {{ $discussion->messages->last()->contenu ?? 'No messages' }}
                </div>
            </div>
        </div>
    </div>
@endforeach
            </div>
        </div>
    </div>

    <!-- Chat Window -->
    <div class="w-3/4 flex flex-col bg-gray-50">
        <div class="border-b p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-purple-400 rounded-full"></div>
                <div>
                    <div class="font-semibold" id="discussion-title">No Discussions</div>
                    <div class="text-xs text-gray-500">Select a discussion to see messages</div>
                </div>
            </div>
        </div>

        <div id="messages" class="flex-1 p-6 overflow-y-auto">
            <!-- Messages will be loaded here dynamically -->
        </div>

        <div class="p-4 border-t">
            <div class="flex items-center space-x-2">
                <input type="text" id="message-input" placeholder="Type Your Message"
                       class="flex-1 p-2 border rounded">
                <button class="p-2 bg-purple-600 text-white rounded" onclick="sendMessage(currentDiscussionId)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
// Global variable to store the current discussion ID
let currentDiscussionId = null;

function loadDiscussionMessages(discussionId) {
    currentDiscussionId = discussionId;  // Set the current discussion ID globally

    // Clear the current messages
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML = '<div class="text-center text-gray-500">Loading messages...</div>';

    // Fetch the messages for the selected discussion
    fetch(`/chat/messages/${discussionId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                messagesDiv.innerHTML = '<div class="text-center text-red-500">' + data.error + '</div>';
                return;
            }

            // Update the discussion title and status
            document.getElementById('discussion-title').textContent = data.titre;

            // Clear the messages div and append the new messages
            messagesDiv.innerHTML = '';  // Clear current messages

            if (data.messages.length === 0) {
                messagesDiv.innerHTML = '<div class="text-center text-gray-500">No messages yet</div>';
            } else {
                data.messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('mb-4');
                    messageDiv.innerHTML = `
                        <div class="text-sm text-gray-600">${message.created_at}</div>
                        <div class="bg-gray-200 p-3 rounded w-max mt-1">
                            ${message.contenu}
                        </div>
                    `;
                    messagesDiv.appendChild(messageDiv);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching messages:', error);
            messagesDiv.innerHTML = '<div class="text-center text-red-500">Error loading messages</div>';
        });
}



function sendMessage(discussionId) {
    const messageContent = document.getElementById('message-input').value;

    if (messageContent.trim() === '') {
        alert('Message content cannot be empty.');
        return;
    }

    // Clear the input after checking
    document.getElementById('message-input').value = '';

    // Send the new message to the backend
    fetch(`/chat/messages/${discussionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            contenu: messageContent
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Dynamically add the new message to the chat window
            const messagesDiv = document.getElementById('messages');
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('mb-4');
            messageDiv.innerHTML = `
                <div class="text-sm text-gray-600">${new Date().toLocaleTimeString()}</div>
                <div class="bg-gray-200 p-3 rounded w-max mt-1">${messageContent}</div>
            `;
            messagesDiv.appendChild(messageDiv);
        } else {
            alert('Error sending message');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error sending message');
    });
}

</script>
