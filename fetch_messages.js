// Get the logged-in user's ID from PHP
const userId = <?php echo $_SESSION['user_id']; ?>;

// JavaScript to dynamically load messages
setInterval(function() {
    fetch('fetch_messages.php')
        .then(response => response.json())
        .then(messages => {
            const messageContainer = document.getElementById('messages_container');
            messageContainer.innerHTML = '';  // Clear the old messages

            messages.forEach(msg => {
                let messageDiv = document.createElement('div');
                messageDiv.classList.add('message', 'p-3', 'rounded-lg', 'mb-2');

                // Check if the message is sent by the logged-in user
                if (msg.sender_id == userId) {
                    messageDiv.classList.add('bg-green-200'); // Apply style for own messages
                    messageDiv.classList.add('self-end'); // Align own messages to the right
                } else {
                    messageDiv.classList.add('bg-gray-200'); // Apply style for other users' messages
                }

                // Add message content
                messageDiv.textContent = msg.message;
                messageContainer.appendChild(messageDiv);
            });
        });
}, 1000); // Check for new messages every second
