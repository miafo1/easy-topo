<?php
session_start();
include('config/dbcon.php');

if (!isset($_SESSION['auth_id']) || $_SESSION['auth_role'] !== 'admin') {
    echo "Unauthorized access!";
    exit(0);
}

$client_id = $_GET['client_id'] ?? null;

// Fetch all clients from the database
$query = "SELECT id, fname, lname FROM user WHERE role_as = 'client'";
$clients = mysqli_query($con, $query);  // This is where the error was occurring

// Handle sending message
if ($client_id && isset($_POST['send_message'])) {
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
              VALUES ('$client_id', '$message', 'admin', '$file_path', '$file_type', NOW())";
    mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-4">
        <div class="grid grid-cols-3 gap-4">
            <!-- Clients List -->
            <div class="col-span-1 bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-4">Clients</h2>
                <ul>
                    <?php while ($client = mysqli_fetch_assoc($clients)): ?>
                        <li class="mb-2">
                            <a href="admin_chat.php?client_id=<?php echo $client['id']; ?>" class="block p-2 bg-blue-100 rounded-lg">
                                <?php echo $client['fname'] . ' ' . $client['lname']; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>

            <!-- Chat Messages -->
            <div class="col-span-2 bg-white shadow-md rounded-lg overflow-hidden">
                <?php if ($client_id): ?>
                    <!-- Messages List -->
                    <div class="h-96 overflow-y-auto p-4 messages">
                        <!-- Messages will be fetched here via JavaScript -->
                    </div>

                    <!-- Message Input Form -->
                    <form method="POST" enctype="multipart/form-data" action="admin_chat.php?client_id=<?php echo $client_id; ?>" class="p-4 border-t">
                        <div class="flex">
                            <input type="text" name="message" class="w-full p-2 border rounded-lg focus:outline-none" placeholder="Type your message">
                            <input type="file" name="file" class="ml-2">
                            <button type="submit" name="send_message" class="ml-2 bg-blue-500 text-white p-2 rounded-lg">Send</button>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="p-4">Select a client to start chatting.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
    function fetchMessages() {
        fetch('fetch_messages_admin.php?client_id=<?php echo $client_id; ?>')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.messages').innerHTML = data;
            });
    }
    setInterval(fetchMessages, 5000);
    </script>

</body>
</html>
