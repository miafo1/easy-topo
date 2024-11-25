<?php
session_start();
include('config/dbcon.php');

if (!isset($_SESSION['auth_id']) || $_SESSION['auth_role'] !== 'client') {
    echo "Unauthorized access!";
    exit(0);
}

$user_id = $_SESSION['auth_id'];

if (isset($_POST['send_message'])) {
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $file_path = null;
    $file_type = null;

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
        $file_type = $_FILES['file']['type'];

        if (in_array($file_type, $allowed_types)) {
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_path = 'uploads/' . time() . '_' . $file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                // File successfully uploaded
            } else {
                echo "Failed to upload file.";
                exit(0);
            }
        } else {
            echo "Invalid file type!";
            exit(0);
        }
    }

    // Insert message into the database
    $query = "INSERT INTO messages (user_id, message, sent_by, file_path, file_type, created_at) 
              VALUES ('$user_id', '$message', 'user', '$file_path', '$file_type', NOW())";
    mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 bg-cover bg-no-repeat" style="background-image: url('assets/img/bg-title-02.jpg');">
    <div class="max-w-6xl mx-auto p-4">
        <!-- Chat Messages -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden h-96 bg-opacity-80">
            <div class="messages p-4 h-full overflow-y-auto">
                <?php
                // Fetch chat messages
                $msg_query = "SELECT * FROM messages WHERE user_id = '$user_id' ORDER BY created_at ASC";
                $msg_result = mysqli_query($con, $msg_query);
                while ($message = mysqli_fetch_assoc($msg_result)) {
                    $align = ($message['sent_by'] == 'user') ? 'text-right' : 'text-left';
                    $bg_color = ($message['sent_by'] == 'user') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black';

                    echo '<div class="mb-4">';
                    echo '<div class="'.$align.'">';
                    echo '<div class="inline-block p-3 rounded-lg '.$bg_color.'">';
                    if ($message['message']) {
                        echo $message['message'];
                    }
                    // Display the file if attached
                    if ($message['file_path']) {
                        $file_link = $message['file_path'];
                        if (strpos($message['file_type'], 'image') !== false) {
                            echo "<br><img src='$file_link' alt='Image' class='w-32 h-32'>";
                        } else {
                            echo "<br><a href='$file_link' download>Download File</a>";
                        }
                    }
                    echo '</div></div></div>';
                }
                ?>
            </div>
        </div>

        <!-- Message Input Form -->
        <form method="POST" enctype="multipart/form-data" action="client_chat.php" class="p-4 border-t bg-opacity-80">
            <div class="flex">
                <input type="text" name="message" class="w-full p-2 border rounded-lg focus:outline-none" placeholder="Type your message">
                <input type="file" name="file" class="ml-2">
                <button type="submit" name="send_message" class="ml-2 bg-blue-500 text-white p-2 rounded-lg">Send</button>
            </div>
        </form>
    </div>

    <script>
    function fetchMessages() {
        fetch('fetch_messages_client.php')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.messages').innerHTML = data;
                scrollToBottom(); // Scroll to the latest message
            });
    }

    function scrollToBottom() {
        var messageContainer = document.querySelector('.messages');
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    setInterval(fetchMessages, 5000);

    // Scroll to bottom on page load
    window.onload = scrollToBottom;
    </script>
</body>
</html>
