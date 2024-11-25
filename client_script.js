const ws = new WebSocket('ws://localhost:8080');

window.onload = function() {
    // Fetch and display previous messages
    fetch('load_messages.php')
        .then(response => response.json())
        .then(messages => {
            const chatBox = document.querySelector('#chat-box');
            if (messages && messages.length > 0) {
                messages.forEach(message => {
                    if (message.file_path) {
                        appendFile(message.file_path, message.sender_type, message.file_type);
                    } else {
                        appendMessage(message.message, message.sender_type);
                    }
                });
            } else {
                console.log("No messages found.");
            }
        })
        .catch(error => console.error("Error loading messages:", error));

    // Register session with WebSocket upon connection
    ws.onopen = function() {
        console.log("WebSocket connection opened.");
        fetch('get_session.php')  // Fetch session data to get user_id and role
            .then(response => response.json())
            .then(sessionData => {
                if (sessionData && sessionData.user_id && sessionData.sender_type) {
                    console.log("Session data:", sessionData);
                    ws.send(JSON.stringify({
                        action: 'register',
                        user_id: sessionData.user_id,
                        sender_type: sessionData.sender_type
                    }));
                } else {
                    console.error("Invalid session data:", sessionData);
                }
            })
            .catch(error => console.error("Error fetching session data:", error));
    };

    ws.onmessage = function(event) {
        const data = JSON.parse(event.data);
        console.log("Received message:", data);
        if (data.file_path) {
            appendFile(data.file_path, data.sender_type, data.file_type);
        } else {
            appendMessage(data.message, data.sender_type);
        }
    };

    ws.onerror = function(error) {
        console.error("WebSocket error:", error);
    };

    ws.onclose = function() {
        console.warn("WebSocket connection closed");
    };

    // Send text message
    document.querySelector('#send-message').addEventListener('click', sendMessage);

    // Open file upload dialog
    document.querySelector('#send-file').addEventListener('click', function() {
        document.querySelector('#file-input').click();
    });

    // Upload and send file
    document.querySelector('#file-input').addEventListener('change', uploadFile);
};

// Append message to chatbox
function appendMessage(message, sender_type) {
    if (!message) {
        console.warn("Undefined message, skipping...");
        return;
    }
    const chatBox = document.querySelector('#chat-box');
    const messageElement = document.createElement('div');
    messageElement.className = sender_type === 'client' ? 'client-message' : 'admin-message';
    messageElement.textContent = message;
    chatBox.appendChild(messageElement);
}

// Append file to chatbox
function appendFile(filePath, sender_type, file_type) {
    const chatBox = document.querySelector('#chat-box');
    const fileElement = document.createElement('div');
    fileElement.className = sender_type === 'client' ? 'client-file' : 'admin-file';

    if (file_type === 'image') {
        const img = document.createElement('img');
        img.src = filePath;
        img.alt = 'uploaded image';
        fileElement.appendChild(img);
    } else {
        const fileLink = document.createElement('a');
        fileLink.href = filePath;
        fileLink.textContent = 'Download ' + file_type;
        fileLink.target = '_blank';
        fileElement.appendChild(fileLink);
    }

    chatBox.appendChild(fileElement);
}

// Send message
function sendMessage() {
    const input = document.querySelector('#message-input');
    const message = input.value.trim();
    if (message === '') {
        console.warn("Message is empty!");
        return;
    }

    // Fetch session data for user_id and sender_type
    fetch('get_session.php')
        .then(response => response.text()) 
        .then(text => {
            console.log("Response from get_session.php:", text);
            try {
                const sessionData = JSON.parse(text); 
                console.log("Session data:", sessionData);
                if (sessionData && sessionData.user_id && sessionData.sender_type) {
                    ws.send(JSON.stringify({
                        action: 'message',
                        user_id: sessionData.user_id,
                        message: message,
                        sender_type: sessionData.sender_type
                    }));
                    appendMessage(message, sessionData.sender_type); 
                    input.value = ''; 
                } else {
                    console.error("Invalid session data:", sessionData);
                }
            } catch (error) {
                console.error("Error parsing session data:", error);
            }
        })
        .catch(error => {
            console.error("Error fetching session data:", error);
        });
}

// Upload and send file
function uploadFile() {
    const fileInput = document.querySelector('#file-input');
    const file = fileInput.files[0];
    if (!file) {
        console.warn("No file selected.");
        return;
    }

    const formData = new FormData();
    formData.append('file', file);

    // Fetch session data for user_id and sender_type
    fetch('get_session.php')
        .then(response => response.json())
        .then(sessionData => {
            if (sessionData && sessionData.user_id && sessionData.sender_type) {
                fetch('upload.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const fileData = {
                            action: 'file',
                            user_id: sessionData.user_id,
                            message: '',
                            file_path: data.file_path,
                            file_type: data.file_type,
                            sender_type: sessionData.sender_type
                        };
                        ws.send(JSON.stringify(fileData));
                        appendFile(data.file_path, sessionData.sender_type, data.file_type);
                    } else {
                        console.error("File upload failed:", data);
                    }
                })
                .catch(error => console.error("Error during file upload:", error));
            } else {
                console.error("Invalid session data:", sessionData);
            }
        })
        .catch(error => console.error("Error fetching session data:", error));
}
