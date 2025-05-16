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
                <div class="flex items-center justify-between cursor-pointer hover:bg-gray-100 p-2 rounded" 
                     onclick="loadDiscussionMessages({{ $discussion->IDdiscussion }})">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-200 rounded-full flex items-center justify-center">
                            <span class="text-yellow-800 font-semibold">{{ substr($discussion->titre, 0, 2) }}</span>
                        </div>
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
        <div class="border-b p-4 flex items-center justify-between bg-white">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold" id="discussion-initial"></span>
                </div>
                <div>
                    <div class="font-semibold" id="discussion-title">No Discussions</div>
                    <div class="text-xs text-gray-500">Select a discussion to see messages</div>
                </div>
            </div>
        </div>

        <div id="messages" class="flex-1 p-6 overflow-y-auto space-y-4">
            <!-- Messages will be loaded here dynamically -->
        </div>

        <div class="p-4 border-t bg-white">
            <div class="flex items-center space-x-2">
                <input type="text" id="message-input" placeholder="Type Your Message"
                       class="flex-1 p-2 border rounded focus:outline-none focus:border-purple-500"
                       onkeypress="if(event.key === 'Enter') sendMessage(currentDiscussionId)">
                <button class="p-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition-colors"
                        onclick="sendMessage(currentDiscussionId)">
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
let currentDiscussionId = null;
const currentUserId = {{ auth()->id() }};

function loadDiscussionMessages(discussionId) {
    currentDiscussionId = discussionId;
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML = '<div class="text-center text-gray-500">Loading messages...</div>';

    fetch(`/chat/messages/${discussionId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                messagesDiv.innerHTML = '<div class="text-center text-red-500">' + data.error + '</div>';
                return;
            }

            document.getElementById('discussion-title').textContent = data.titre;
            document.getElementById('discussion-initial').textContent = data.titre.substring(0, 2).toUpperCase();

            messagesDiv.innerHTML = '';

            if (data.messages.length === 0) {
                messagesDiv.innerHTML = '<div class="text-center text-gray-500">No messages yet</div>';
            } else {
                data.messages.forEach(message => {
                    const isCurrentUser = message.auteur === currentUserId;
                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('mb-4');
                    
                    messageDiv.innerHTML = `
                        <div class="flex ${isCurrentUser ? 'justify-end' : 'justify-start'}">
                            <div class="max-w-[70%]">
                                <div class="text-xs text-gray-500 ${isCurrentUser ? 'text-right' : 'text-left'} mb-1">
                                    ${message.created_at}
                                </div>
                                <div class="${isCurrentUser 
                                    ? 'bg-purple-600 text-white' 
                                    : 'bg-gray-200 text-gray-800'} 
                                    p-3 rounded-lg shadow-sm">
                                    ${message.contenu}
                                </div>
                            </div>
                        </div>
                    `;
                    messagesDiv.appendChild(messageDiv);
                });
                
                // Scroll to the bottom of the messages
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }
        })
        .catch(error => {
            console.error('Error fetching messages:', error);
            messagesDiv.innerHTML = '<div class="text-center text-red-500">Error loading messages</div>';
        });
}

function sendMessage(discussionId) {
    const messageInput = document.getElementById('message-input');
    const messageContent = messageInput.value;

    if (!discussionId) {
        alert('Please select a discussion first.');
        return;
    }

    if (messageContent.trim() === '') {
        alert('Message content cannot be empty.');
        return;
    }

    messageInput.value = '';

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
            const messagesDiv = document.getElementById('messages');
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('mb-4');
            messageDiv.innerHTML = `
                <div class="flex justify-end">
                    <div class="max-w-[70%]">
                        <div class="text-xs text-gray-500 text-right mb-1">
                            ${data.message.created_at}
                        </div>
                        <div class="bg-purple-600 text-white p-3 rounded-lg shadow-sm">
                            ${messageContent}
                        </div>
                    </div>
                </div>
            `;
            messagesDiv.appendChild(messageDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
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
