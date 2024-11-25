<?php
session_start();

if (isset($_REQUEST["grand_total"])) {
    // Retrieve grand_total and item_ids from request
    $grand_total = $_REQUEST["grand_total"];
    $item_ids = isset($_REQUEST['item_ids']) ? $_REQUEST['item_ids'] : '';
    $land_ids = isset($_REQUEST['land_ids']) ? $_REQUEST['land_ids'] : '';

    // Store the item_ids and grand_total in session variables
    $_SESSION['item_ids'] = $item_ids;
    $_SESSION['land_ids'] = $land_ids;
    $_SESSION['grand_total'] = $grand_total;

    // Check if user is logged in and retrieve their session data
    if (isset($_SESSION['auth_user']['user_id']) && isset($_SESSION['auth_user']['user_name'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
        $first_name = $_SESSION['auth_user']['user_name'];
        
    } else {
        // If user is not logged in or session data is missing, redirect them to login or show an error
        echo "User information is missing. Please log in.";
        exit;
    }

    require_once 'monetbil-php-master/monetbil.php';

    // Setup Monetbil arguments
    Monetbil::setAmount($grand_total); // Use the grand_total passed from the cart
    Monetbil::setCurrency('XAF');
    Monetbil::setLocale('en'); // Display language fr or en
    Monetbil::setPhone(''); // Optionally fill this with user phone
    Monetbil::setCountry(''); // Optionally fill this with user country
    Monetbil::setItem_ref($land_ids); // Pass the item IDs as a reference for the items being paid for
    Monetbil::setPayment_ref(md5(uniqid())); // Generate a unique payment reference
    Monetbil::setUser($user_id); // Pass user ID dynamically from session
    Monetbil::setFirst_name($first_name); // Pass user's first name dynamically from session
    Monetbil::setLast_name($first_name); // Pass user's last name dynamically from session
    Monetbil::setEmail('jean.kamdem@email.com'); // Optionally replace this with session or database email if available
    Monetbil::setReturn_url('http://localhost/easytopo/term.php'); // Redirect URL after payment success
    Monetbil::setNotify_url('your_notification_url_to_receive_payment_data'); // URL to receive payment notification
    Monetbil::setLogo('https://storage.googleapis.com/cdn.ucraft.me/userFiles/ukuthulamovies/images/937-your-logo.png'); // Optional logo

    // Start a payment
    // You will be redirected to the payment page
    Monetbil::startPayment();
} else {
    // If no grand_total or item_ids are passed, redirect to the cart page or show an error
    echo "No items found for checkout.";
}
