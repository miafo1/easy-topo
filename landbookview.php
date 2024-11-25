<?php
// Database connection
include('config/dbcon.php');

// Fetch all transactions where status is 1 (active)
$query = "SELECT * FROM transactions WHERE status = 1";
$result = mysqli_query($con, $query);

// Check if the query ran successfully
if (!$result) {
    die("Database error: " . mysqli_error($con));
}

if (isset($_POST['change_status']) && isset($_POST['land_id']) && isset($_POST['transaction_id'])) {
    $land_id = $_POST['land_id']; // Get the selected land_id
    $transaction_id = $_POST['transaction_id'];

    // Update land status to 'available'
    $update_query = "UPDATE land SET statusland = 'available' WHERE idland = '$land_id' AND statusland = 'reserved'";
    mysqli_query($con, $update_query);

    // Check if all lands in this transaction are now available
    $land_check_query = "SELECT item_ids FROM transactions WHERE transactionid = '$transaction_id'";
    $land_check_result = mysqli_query($con, $land_check_query);
    $row = mysqli_fetch_assoc($land_check_result);
    $item_ids = explode(',', $row['item_ids']); // Split land IDs

    $all_available = true;
    foreach ($item_ids as $id) {
        $status_query = "SELECT statusland FROM land WHERE idland = '$id'";
        $status_result = mysqli_query($con, $status_query);
        $status_row = mysqli_fetch_assoc($status_result);
        if ($status_row['statusland'] != 'available') {
            $all_available = false;
            break;
        }
    }

    // If all lands are available, mark the transaction as complete
    if ($all_available) {
        $update_transaction_query = "UPDATE transactions SET status = 0 WHERE transactionid = '$transaction_id'";
        mysqli_query($con, $update_transaction_query);
    }
}

// HTML structure to display the transactions
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Reservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Manage Reservations</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 border">Transaction ID</th>
                        <th class="py-2 px-4 border">User ID</th>
                        <th class="py-2 px-4 border">Land ID</th>
                        <th class="py-2 px-4 border">Amount</th>
                        <th class="py-2 px-4 border">Reference</th>
                        <th class="py-2 px-4 border">Make Available</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each transaction
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_ids = explode(',', $row['item_ids']); // Get the land IDs

                        foreach ($item_ids as $land_id) {
                            // Fetch land details
                            $land_query = "SELECT * FROM land WHERE idland = '$land_id'";
                            $land_result = mysqli_query($con, $land_query);

                            // Check if query was successful
                            if (!$land_result) {
                                echo "<!-- Error in land query: " . mysqli_error($con) . " -->";
                                continue;
                            }

                            $land_row = mysqli_fetch_assoc($land_result);

                            // Check if land_row is valid
                            if (!$land_row) {
                                echo "<!-- No matching land found for land_id: $land_id -->";
                                continue;
                            }

                            // Display each land within a transaction
                            echo "<tr class='text-center'>";
                            echo "<td class='py-2 px-4 border'>" . $row['transactionid'] . "</td>";
                            echo "<td class='py-2 px-4 border'>" . $row['user_id'] . "</td>";
                            echo "<td class='py-2 px-4 border'>" . $land_row['idland'] . "</td>";
                            echo "<td class='py-2 px-4 border'>" . $row['amount'] . " XAF</td>";
                            echo "<td class='py-2 px-4 border'>" . $row['reference'] . "</td>";

                            // Show the button to make land available if it's currently reserved
                            if ($land_row['statusland'] == 'reserved') {
                                echo "<td class='py-2 px-4 border'>
                                        <form method='POST'>
                                            <input type='hidden' name='land_id' value='" . $land_row['idland'] . "' />
                                            <input type='hidden' name='transaction_id' value='" . $row['transactionid'] . "' />
                                            <button type='submit' name='change_status' class='bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded'>
                                                Make Available
                                            </button>
                                        </form>
                                      </td>";
                            } else {
                                echo "<td class='py-2 px-4 border text-gray-500'>Available</td>";
                            }

                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
