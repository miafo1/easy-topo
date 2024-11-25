<?php
session_start(); // Ensure the session is started to access session variables

include('config/dbcon.php'); // Include database connection

// Sanitize and retrieve the user_id from request (not from session)
$client_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($client_id > 0) {
    // Fetch messages for both the client and the admin
    $stmt = $con->prepare("SELECT id, message, sender_type, timestamp FROM messages WHERE user_id = ? OR sender_id = ?");
    $stmt->bind_param('ii', $client_id, $client_id); // Bind client_id twice to handle both sender and recipient

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $messages = [];

        // Fetch the messages
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        // Return the messages as JSON
        echo json_encode($messages);
    } else {
        // Handle query failure
        echo json_encode(['error' => 'Could not load messages.']);
    }

    $stmt->close(); // Close the statement
} else {
    // Handle invalid user_id case
    echo json_encode(['error' => 'Invalid user session.']);
}

$con->close(); // Close the connection

