<?php
session_start();
include('config/dbcon.php');
if (isset($_POST['login_btn'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $passwd = mysqli_real_escape_string($con, $_POST['password']);
    $password = sha1($passwd);
    
    $login_query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {

        foreach ($login_query_run as $data) {
            $user_id = $data['id'];
            $user_name = $data['fname'].' '.$data['lname'];
            $user_email = $data['email'];
            $role_as = $data['role_as'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role_as";
        $_SESSION['auth_id'] = "$user_id";
         $_SESSION['auth_name'] = "$user_name";
            $_SESSION['auth_user'] = [
                'user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
            ];

        if ($_SESSION['auth_role'] == "admin") { //admin user logging
            $_SESSION['message'] = "Welcome to dashboard";
            header('location: indexadmin.php');
            exit(0);
            
        } elseif ($_SESSION['auth_role'] == "client") { //normal user logging
            $_SESSION['message'] = "You are looged in";
            header('location: indexuser.php');
            exit(0);
        }elseif ($_SESSION['auth_role'] == "surveyor") { //survayor user logging
            $_SESSION['message'] = "You are looged in";
            header('location: surveyor.php');
            exit(0);
        }
    } else {

        $_SESSION['message'] = "Invalid email or password";
        header('location: index.php ');
        exit(0);
    }
} else {

}
?>
//<?php
//// Assuming you have established a database connection
//session_start();
//include('config/dbcon.php');
//if (isset($_POST['login_btn'])) {
//
//    $email = mysqli_real_escape_string($con, $_POST['email']);
//   $password = mysqli_real_escape_string($con, $_POST['password']);
//
//    // Prepare and execute the SQL query
//    $login_query = "SELECT * FROM user WHERE email='$email' AND password='$password' LIMIT 1";
//     $login_query_run = mysqli_query($con, $login_query);
//   
//    // Check if a matching record is found
//    if ($login_query_run->num_rows === 1) {
//        $row = $login_query_run->fetch_assoc();
//        $hashedPassword = $row["password"];
//        if (password_verify($password, $hashedPassword)) {
//            // Authentication successful, set session variables and redirect to appropriate page
//            
//            $_SESSION["user_id"] = $row["id"];
//            $_SESSION["user_role"] = $row["role_as"];
//            if ($row["role_as"] == 1) {
//                header("Location: indexadmin.php");
//            } elseif ($row["role_as"] == 0) {
//                header("Location: indexuser.php");
//            }
//            exit();
//        }
//    }
//
//    // If authentication fails, redirect back to the login form with an error message
//    header("Location: index.php?error=1");
//    exit();
//}
//?>