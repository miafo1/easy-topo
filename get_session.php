<?php
session_start();

$response = [
    "user_id" => isset($_SESSION['auth_id']) ? $_SESSION['auth_id'] : null,
    "sender_type" => isset($_SESSION['auth_role']) ? $_SESSION['auth_role'] : null
];

echo json_encode($response);
?>
