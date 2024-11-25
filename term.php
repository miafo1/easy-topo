<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-gray-100">
    <?php
    // Open the log file in append mode
    $logfile = 'easytopobooklog.txt';
    $monfichier = fopen($logfile, 'a');

    // Check if the file opened successfully
    if (!$monfichier) {
        die("Error: Unable to open log file.");
    }

    // Start logging
    fputs($monfichier, "---------------------\n");
    fputs($monfichier, "Transaction started at: " . date('Y-m-d H:i:s') . "\n");

    // Get data from request and session
    $idReqDoh = $_GET['status'];

    if (isset($idReqDoh)) {
        include('config/dbcon.php');

        if ($idReqDoh == 'success') {
            fputs($monfichier, "This payment is recognized by Monetbil!\n");

            // Gather session variables
            $name = $_SESSION['auth_user']['user_name'];
            $email = $_SESSION['auth_user']['user_email'];
            $id = $_SESSION['auth_user']['user_id'];
            $city = 'YAOUNDE';
            $country = 'CAMEROON';
            $amount = $_SESSION['grand_total'];
            $item_ids = $_SESSION['land_ids'];

            // Convert the item_ids string to an array
            $item_ids_array = explode(',', $item_ids);

            // Initialize an array to store land names
            $land_names = [];

            // Prepare statements to avoid SQL injection
            $land_stmt = mysqli_prepare($con, "SELECT titleland FROM land WHERE idland=?");
            $update_stmt = mysqli_prepare($con, "UPDATE land SET statusland='reserved' WHERE idland=?");

            // Loop through each item_id and fetch the land details
            foreach ($item_ids_array as $item_id) {
                // Fetch land details
                mysqli_stmt_bind_param($land_stmt, "s", $item_id);
                mysqli_stmt_execute($land_stmt);

                // Store results
                mysqli_stmt_store_result($land_stmt);
                mysqli_stmt_bind_result($land_stmt, $land_title);
                
                // Fetch result
                if (mysqli_stmt_fetch($land_stmt)) {
                    $land_names[] = $land_title;

                    // Update the land status
                    mysqli_stmt_bind_param($update_stmt, "s", $item_id);
                    if (!mysqli_stmt_execute($update_stmt)) {
                        fputs($monfichier, "Error updating land status for item_id: $item_id. Error: " . mysqli_error($con) . "\n");
                    }
                } else {
                    fputs($monfichier, "Error fetching land title for item_id: $item_id\n");
                }
            }

            // Clean up prepared statements
            mysqli_stmt_close($land_stmt);
            mysqli_stmt_close($update_stmt);

            // Join the land names into a string
            $land_names_string = implode(', ', $land_names);

            // Generate a unique reference
            $unique_reference = uniqid('TXN-');

            // Insert transaction details into the transactions table
            $insert_transaction_query = mysqli_query($con, 
            "INSERT INTO transactions 
            (name, email, city, country, amount, user_id, item_ids, item_names, reference) 
            VALUES 
            ('$name', '$email', '$city', '$country', '$amount', '$id', '$item_ids', '$land_names_string', '$unique_reference')");
        
            if (!$insert_transaction_query) {
                fputs($monfichier, "Database error: " . mysqli_error($con) . "\n");
            } else {
                fputs($monfichier, "Transaction inserted successfully\n");
                fputs($monfichier, "Lands reserved: $land_names_string\n");
                fputs($monfichier, "Transaction reference: $unique_reference\n");

                // Output success message to the user
                echo "<div class='order-message-container bg-green-100 p-6 rounded-lg shadow-md text-center animate__animated animate__fadeIn'>
                        <div class='message-container bg-white p-5 rounded shadow-lg'>
                            <h3 class='text-2xl font-bold text-green-600 mb-4'>Thank you for reserving!</h3>
                            <div class='order-detail'></div>
                            <div class='customer-details text-left'>
                                <p>Your ID: <span class='font-semibold'>$id</span></p>
                                <p>Reserved Land IDs: <span class='font-semibold'>$item_ids</span></p>
                                <p>Reserved Land Names: <span class='font-semibold'>$land_names_string</span></p>
                                <p>Your Transaction Reference: <span class='font-semibold'>$unique_reference</span></p>
                                <p>Your name: <span class='font-semibold'>$name</span></p>
                                <p>Your email: <span class='font-semibold'>$email</span></p>
                                <p>Your address: <span class='font-semibold'>$city, $country</span></p>
                                <p>Total paid: <span class='font-semibold'>$amount XAF</span></p>
                                <p class='mt-2 text-sm'>(*You will be contacted*)</p>
                            </div>
                            <a href='products.php?town_id=1' class='btn bg-blue-500 text-white py-2 px-4 rounded mt-6'>Continue reserving</a>
                            <button id='downloadPDF' class='mt-4 btn bg-gray-500 text-white py-2 px-4 rounded'>Download PDF</button>
                        </div>
                      </div>";
            }
        } else {
            fputs($monfichier, "Payment not recognized by DOHONE\n");
        }
    } else {
        fputs($monfichier, "User accessed the site without making a request.\n");
    }

    // End transaction logging
    fputs($monfichier, "Transaction ended at: " . date('Y-m-d H:i:s') . "\n");
    fclose($monfichier);
    ?>
    
    <!-- jsPDF for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('downloadPDF').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.text("Thank you for reserving!", 10, 10);
            doc.text("Your name: <?php echo $name; ?>", 10, 20);
            doc.text("Your email: <?php echo $email; ?>", 10, 30);
            doc.text("Reserved Lands: <?php echo $land_names_string; ?>", 10, 40);
            doc.text("Transaction Reference: <?php echo $unique_reference; ?>", 10, 50);
            doc.text("Total paid: <?php echo $amount; ?> XAF", 10, 60);
            
            doc.save("Receipt.pdf");
        });
    </script>
</body>
</html>
