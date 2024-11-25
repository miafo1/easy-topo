<?php
$mysqli = new mysqli("localhost", "username", "password", "easytopo");

$message_id = (int)$_GET['message_id'];

if ($mysqli->query("DELETE FROM messages WHERE id = $message_id")) {
    http_response_code(200);
} else {
    http_response_code(500);
}
?>
