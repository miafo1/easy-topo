const ws = new WebSocket('ws://localhost:8080');

document.addEventListener('DOMContentLoaded', function() {
    loadClients();
    document.querySelector('#admin-send-message').addEventListener('click', sendAdminMessage);
    document.querySelector('#search-client').addEventListener('input', filterClients);

    ws.onmessage = function(event) {
        const data = JSON.parse(event.data);
        if (data.user_id == currentUserId) {
            appendAdminMessage(data.message, data.sender_type, data.timestamp);
        }
    };
});

let currentUserId = null;

function loadClients() {
    fetch('load_clients.php')
        .then(response => response.json())
        .then(clients => {
            const clientList = document.querySelector('#client-list');
            clientList.innerHTML = '';
            clients.forEach(client => {
                const clientElement = document.createElement('div');
                clientElement.className = 'client';
                clientElement.innerText = client.username;
                clientElement.dataset.userId = client.id;
                clientElement.addEventListener('click', () => loadClientMessages(client.id));
                clientList.appendChild(clientElement);
            });
        });
}

function filterClients() {
    const searchQuery = document.querySelector('#search-client').value.toLowerCase();
    const clients = document.querySelectorAll('#client-list .client');
    
    clients.forEach(client => {
        if (client.innerText.toLowerCase().includes(searchQuery)) {
            client.style.display = '';
        } else {
            client.style.display = 'none';
        }
    });
}

function loadClientMessages(userId) {
    currentUserId = userId;
    fetch(`load_messages.php?user_id=${userId}`)
        .then(response => response.json())
        .then(messages => {
            const chatBox = document.querySelector('#chat-box');
            chatBox.innerHTML = '';
            messages.forEach(message => {
                appendAdminMessage(message.message, message.sender_type, message.timestamp, message.id);
            });
        });
}

function sendAdminMessage() {
    const input = document.querySelector('#admin-message-input');
    const message = input.value.trim();
    const fileInput = document.querySelector('#admin-file-input');
    const file = fileInput.files[0];

    if (message === '' && !file) return;

    const formData = new FormData();
    formData.append('user_id', currentUserId);
    formData.append('message', message);
    formData.append('sender_type', 'admin');
    if (file) {
        formData.append('file', file); // Append the file to the FormData
    }

    fetch('save_message.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            ws.send(JSON.stringify({
                user_id: currentUserId,
                message: message,
                file_path: file ? file.name : '',
                sender_type: 'admin',
                timestamp: new Date().toLocaleString() 
            }));

            input.value = '';
            fileInput.value = '';  // Clear the file input after sending
            appendAdminMessage(message, 'admin', new Date().toLocaleString());
        }
    });
}


function appendAdminMessage(message, sender_type, timestamp) {
    const chatBox = document.querySelector('#chat-box');
    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message', sender_type);

    const messageText = document.createElement('span');
    messageText.innerText = message;

    const timestampElement = document.createElement('span');
    timestampElement.classList.add('timestamp');
    timestampElement.innerText = timestamp;

    messageElement.appendChild(messageText);
    messageElement.appendChild(timestampElement);
    chatBox.appendChild(messageElement);

    // Scroll to the bottom
    chatBox.scrollTop = chatBox.scrollHeight;
}
