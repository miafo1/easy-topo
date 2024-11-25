<?php
session_start();
include('config/dbcon.php'); 

$result = $con->query("SELECT id, fname FROM user");

if ($result) {
    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
    echo json_encode($clients);
} else {
    // Handle error
    echo json_encode(['error' => 'Could not load clients.']);
}

$con->close(); // Close the connection correctly
?>
