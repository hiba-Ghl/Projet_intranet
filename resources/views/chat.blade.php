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
            <div class="flex space-x-4 mb-6">
                @foreach (['Nichol', 'Titus', 'Geoffrey', 'Laverty'] as $name)
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full mx-auto border-2 border-green-500"></div>
                        <div class="text-sm mt-1">{{ $name }}</div>
                    </div>
                @endforeach
            </div>

            <div class="font-semibold mb-2">All Chats</div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-2 bg-gray-100 rounded">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-200 rounded-full"></div>
                        <div>
                            <div class="font-medium">Mark Williams</div>
                            <div class="text-xs text-gray-500">is typing…</div>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500">02:40 PM</span>
                </div>

                <div class="flex items-center justify-between p-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-200 rounded-full"></div>
                        <div>
                            <div class="font-medium">Sarika Jain</div>
                            <div class="text-xs text-gray-500">Do you know which.</div>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500">06:12 AM</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Window -->
    <div class="w-3/4 flex flex-col bg-gray-50">
        <div class="border-b p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-purple-400 rounded-full"></div>
                <div>
                    <div class="font-semibold">Edward Lietz</div>
                    <div class="text-xs text-green-500">Online</div>
                </div>
            </div>
        </div>

        <div class="flex-1 p-6 overflow-y-auto">
            <div class="mb-4">
                <div class="text-sm text-gray-600">02:39 PM</div>
                <div class="bg-gray-200 p-3 rounded w-max mt-1">
                    Hi there! I'm interested in your services.
                </div>
            </div>

            <div class="mb-4">
                <div class="text-sm text-gray-600">02:39 PM</div>
                <div class="bg-gray-200 p-3 rounded w-max mt-1">
                    Can you tell me more about what you offer? Can you explain it briefly...
                </div>
            </div>

            <div class="mb-4 text-right">
                <div class="text-sm text-gray-600">02:39 PM</div>
                <div class="bg-purple-600 text-white p-3 rounded w-max ml-auto">
                    Hello! Absolutely, we provide a range of services tailored to meet various business needs. Could you specify what you're looking for?
                </div>
                <div class="flex justify-end space-x-2 mt-1 text-gray-600 text-sm">
                    <span>😊 24</span>
                    <span>❤️ 15</span>
                    <span>👍 15</span>
                </div>
            </div>
        </div>

        <div class="p-4 border-t">
            <div class="flex items-center space-x-2">
                <input type="text" placeholder="Type Your Message"
                       class="flex-1 p-2 border rounded">
                <button class="p-2 bg-purple-600 text-white rounded">
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
