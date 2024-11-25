<?php
session_start();
include('config/dbcon.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register_btn'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telephone = mysqli_real_escape_string($con, $_POST['telephone']);
    $passwd = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($passwd == $confirm_password) {
        $checkemail = "SELECT email FROM user WHERE email='$email'"; 
        $checkemail_run = mysqli_query($con, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['message'] = "Email already exists";
            header('location: index.php');
            exit(0);
        } else {
            $password = sha1($passwd); // Use password_hash for better security
            $user_query = "INSERT INTO user (fname, lname, email, phone, password) VALUES ('$fname', '$lname', '$email', '$telephone', '$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                // Get the ID of the newly registered user
                $user_id = mysqli_insert_id($con); // Get the last inserted ID

                // Set session variables
                $_SESSION['auth'] = true;  // Indicates user is authenticated
                $_SESSION['auth_id'] = $user_id; // Store user ID in session
                $_SESSION['auth_role'] = 'client'; // Set user role, adjust as necessary
                $_SESSION['auth_name'] = $fname . ' ' . $lname; // Store full name

                $_SESSION['message'] = "Registered Successfully";
                header('location: indexuser.php');
                exit(0);
            } else { 
                $_SESSION['message'] = "Something Went Wrong: " . mysqli_error($con); // Improved error message
                header('location: index.php');
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "Password and Confirm Password do not match";
        header('location: index.php');
        exit(0);
    }
} else {
    header('location: index.php');
    exit(0);
}
?>
