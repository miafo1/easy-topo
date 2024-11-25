<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="chat-container">
        <div id="chat-box"></div>
        <div id="input-area">
            <input type="file" id="file-input" style="display:none;" />
            <button id="send-file">📎</button>
            <input type="text" id="message-input" placeholder="Type a message">
            <button id="send-message">Send</button>
        </div>
    </div>

    <script src="client_script.js"></script>
</body>
</html>
