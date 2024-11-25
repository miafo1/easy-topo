<?php
include('config/dbcon.php');
session_start();
if(isset($_POST['logout_btn'])){
    session_destroy();
    unset($_SESSION['auth']); 
    header('location: index.php ');
}
?>