<?php
require 'vendor/autoload.php';
include 'config/dbcon.php';  // Include database connection

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $userConnections;  // To map user IDs to WebSocket connections

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->userConnections = [];
    }

    // Handle new WebSocket connection
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    // Handle incoming messages
    public function onMessage(ConnectionInterface $from, $msg) {
        global $con;  // Use the global $con variable from dbcon.php

        $data = json_decode($msg, true);
        error_log("Received message: " . json_encode($data)); // Log received message

        // Registration of user connections (clients/admins)
        if (isset($data['action']) && $data['action'] === 'register' && isset($data['user_id'], $data['sender_type'])) {
            $this->userConnections[$data['user_id']] = $from; // Register connection
            return;
        }

        // Validate incoming data for message or file
        if (isset($data['user_id'], $data['sender_type'])) {
            $message = isset($data['message']) ? $data['message'] : null;
            $filePath = isset($data['file_path']) ? $data['file_path'] : null;
            $fileType = isset($data['file_type']) ? $data['file_type'] : null;

            // Prepare the recipient and sender details
            $admin_id = ($data['sender_type'] === 'admin') ? $data['user_id'] : null;
            $sent_by = ($data['sender_type'] === 'admin') ? 'admin' : 'client';

            // Check if the database connection is valid
            if (!$con) {
                error_log("Database connection failed");
                return;
            }

            // Store the message in the database
            $stmt = $con->prepare("INSERT INTO messages (user_id, admin_id, message, file_path, sent_by, file_type) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                error_log("Prepare failed: " . $con->error);
                return;
            }

            $stmt->bind_param("iissss", $data['user_id'], $admin_id, $message, $filePath, $sent_by, $fileType);
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error); // Log execution error
                return;
            }
            $stmt->close();

            // Determine the recipient (admin or client)
            if ($data['sender_type'] === 'client') {
                $recipientConnection = $this->userConnections['admin'] ?? null;  // Send to admin
            } else {
                $recipientConnection = $this->userConnections[$data['user_id']] ?? null;  // Send to specific client
            }

            // Send the message to the intended recipient
            if ($recipientConnection) {
                $recipientConnection->send($msg);
            } else {
                error_log("Recipient not found for message: " . json_encode($data));
            }
        } else {
            error_log("Invalid message format: " . json_encode($data));
        }
    }

    // Handle WebSocket connection closing
    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        // Remove the user connection from the map
        foreach ($this->userConnections as $user_id => $connection) {
            if ($connection === $conn) {
                unset($this->userConnections[$user_id]);
                break;
            }
        }
    }

    // Handle WebSocket errors
    public function onError(ConnectionInterface $conn, \Exception $e) {
        error_log("WebSocket error: " . $e->getMessage());
        $conn->close();
    }
}

// Start WebSocket server
$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new Chat()
        )
    ),
    8080  // WebSocket server port
);

$server->run();
