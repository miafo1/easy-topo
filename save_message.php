<?php
session_start();
include('config/dbcon.php'); 

// Get data from POST request
$client_id = intval($_POST['user_id']);
$message = trim($_POST['message']);
$sender_type = $_POST['sender_type'];
$file_path = isset($_POST['file_path']) ? $_POST['file_path'] : ''; // Handle file upload

// Assuming the admin's ID is stored in the session
$admin_id = isset($_SESSION['auth_id']) ? intval($_SESSION['auth_id']) : 0;

if ($client_id > 0 && $admin_id > 0 && !empty($message)) {
    $stmt = $con->prepare("INSERT INTO messages (user_id, sender_id, message, sender_type, file_path, timestamp) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param('iisss', $client_id, $admin_id, $message, $sender_type, $file_path);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to save message.']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid input.']);
}

$con->close();
?>
