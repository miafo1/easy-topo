<?php
// session_start(); // Start the session at the top

if (isset($_SESSION['message'])) {
    ?> 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey! </strong> <?= htmlspecialchars($_SESSION['message']); // Prevent XSS ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" style="color: red"></button>
        </div>
    <?php
    unset($_SESSION['message']);
}
?>
