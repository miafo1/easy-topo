<?php
session_start();
include('config/dbcon.php');

if (!isset($_SESSION['auth_id']) || $_SESSION['auth_role'] !== 'client') {
    echo "Unauthorized access!";
    exit(0);
}

$user_id = $_SESSION['auth_id'];

// Fetch chat messages from the database
$query = "SELECT * FROM messages WHERE user_id = '$user_id' ORDER BY created_at ASC";
$result = mysqli_query($con, $query);

while ($message = mysqli_fetch_assoc($result)) {
    $align = ($message['sent_by'] == 'user') ? 'text-right' : 'text-left';
    $bg_color = ($message['sent_by'] == 'user') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black';
    $formatted_time = date('h:i A', strtotime($message['created_at'])); // Format the time

    echo '<div class="mb-4">';
    echo '<div class="'.$align.'">';
    echo '<div class="inline-block p-3 rounded-lg '.$bg_color.'">';
    
    // Display the message content
    if ($message['message']) {
        echo $message['message'];
    }

    // Display file if attached
    if ($message['file_path']) {
        $file_link = $message['file_path'];
        if (strpos($message['file_type'], 'image') !== false) {
            echo "<br><img src='$file_link' alt='Image' class='w-32 h-32'>";
        } else {
            echo "<br><a href='$file_link' download>Download File</a>";
        }
    }

    // Display the time below the message
    echo "<div class='text-xs text-gray-500 mt-1'>$formatted_time</div>";
    
    echo '</div></div></div>';
}
?>
