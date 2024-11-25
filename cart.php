<?php
session_start();
include('config/dbcon.php');

// Remove individual items from the cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM cart WHERE id = '$remove_id'");
    header('location:cart.php');
}

// Remove all items from the cart
if (isset($_GET['delete_all'])) {
    mysqli_query($con, "DELETE FROM cart");
    header('location:cart.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">
   <h1 class="heading">Shopping Cart</h1>

   <table>
      <thead>
         <th>Image</th>
         <th>Location</th>
         <th>Description</th>
         <th>Action</th>
      </thead>

      <tbody>

         <?php 
         $select_cart = mysqli_query($con, "SELECT * FROM cart");
         $grand_total = 0;
         $item_ids = []; // Array to store all item IDs in the cart
         $item_land_ids = [];
         
         if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
               // Assuming 'land_id' is the correct reference for the land table
               $item_ids[] = $fetch_cart['id']; 
               $item_land_ids[] = $fetch_cart['land_id'];
               $grand_total += 1; // Adjust this as per your grand total logic
               
         ?>

         <tr>
            <td><img src="uploads/posts/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['location']; ?></td>
            <td><?php echo $fetch_cart['descriptionland']; ?></td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
         </tr>

         <?php
            }
         } else {
            echo '<tr><td colspan="4" class="text-center">Your cart is empty!</td></tr>';
         }
         ?>

         <tr class="table-bottom">
            <td><a href="products.php?town_id=1" class="option-btn" style="margin-top: 0;">Continue Reserving</a></td>
            <td colspan="2">Grand Total</td>
            <td><?php echo $grand_total; ?>fr</td>
         </tr>
      </tbody>
   </table>

   <?php if (!empty($item_land_ids)) { ?>
   <div class="checkout-btn">
      <!-- Pass the grand total and item IDs as a comma-separated string in the URL -->
      <a href="pay.php?grand_total=<?php echo $grand_total; ?>&item_ids=<?php echo implode(',', $item_ids); ?>&land_ids=<?php echo implode(',', $item_land_ids); ?>" class="btn">Proceed to Checkout</a>
      </div>
   <?php } ?>

</section>

</div>

<!-- Custom JS File Link -->
<script src="script.js"></script>

</body>
</html>
