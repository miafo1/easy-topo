<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Consultation</title>
<!-- In your HTML, include the Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .chat-message.admin {
        justify-content: flex-end;
        background-color: #DCF8C6;
    }
    .chat-message.client {
        justify-content: flex-start;
        background-color: #FFFFFF;
    }
    .chat-message {
        display: flex;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 10px;
        max-width: 60%;
        position: relative;
    }
    .timestamp {
        font-size: 0.75rem;
        color: gray;
        margin-left: 10px;
    }
</style>

</head>
<body>
<div class="h-screen flex flex-col">
    <div class="bg-gray-100 p-4 flex items-center justify-between">
        <input type="text" id="search-client" placeholder="Search clients" class="w-full p-2 rounded-md">
    </div>
    <div class="flex flex-grow overflow-hidden">
        <div id="client-list" class="w-1/4 bg-gray-200 overflow-y-auto p-4">
            <!-- Client list loaded here -->
        </div>
        <div id="chat-box" class="w-3/4 bg-white p-4 flex flex-col-reverse overflow-y-auto">
            <!-- Chat messages loaded here -->
        </div>
    </div>
    <div class="bg-gray-100 p-4 flex items-center space-x-2">
        <input type="text" id="admin-message-input" placeholder="Type a message" class="w-full p-2 border border-gray-300 rounded-md">
        <input type="file" id="admin-file-input" class="hidden">
        <button id="admin-send-message" class="bg-blue-500 text-white p-2 rounded-md">Send</button>
    </div>
</div>


    <script src="admin_script.js"></script>
</body>
</html>
