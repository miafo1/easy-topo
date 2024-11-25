<?php
session_start();
include('config/dbcon.php');

// Assuming client/admin session has user_id
$sender_id = $_SESSION['user_id']; 
$recipient_id = $_POST['recipient_id']; 
$message = $_POST['message'] ?? null;
$file = $_FILES['file'] ?? null;

if ($message || $file) {
    $file_path = null;

    // Handle file upload if a file is sent
    if ($file) {
        $target_dir = "uploads/";
        $file_path = $target_dir . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $file_path);
    }

    // Insert the message into the database
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, recipient_id, message, file_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $sender_id, $recipient_id, $message, $file_path);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to the chat page
header("Location: chat_page.php");
exit();
?>
