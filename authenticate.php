<?php 

session_start();
include('config/dbcon.php');


if(!isset($_SESSION['auth'])) {

    $_SESSION['message'] = "Login To Access Dashboard";
    header('location: index.php');
    exit(0);

} else {

if($_SESSION['auth_role'] == "1") {

    $_SESSION['message'] = "you are not authorized as ADMIN";
    header('location: index.php');
    exit(0);
}
} 


?>