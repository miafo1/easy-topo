<?php

include('config/dbcon.php');

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   
   $email = $_POST['email'];
   
   
   $telephone = $_POST['telephone'];
   $city = $_POST['city'];
  
   $country = $_POST['country'];
 

   $cart_query = mysqli_query($con, "SELECT * FROM cart");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['descriptionland'];
         
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($con, "INSERT INTO `transactions` (name, email,phonenumber, city, country) VALUES('$name', '$email', '$telephone', '$city', '$country')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for reserving!</h3>
         <div class='order-detail'>
           
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$telephone.", ".$city.", ".$country."</span> </p>
            
            <p>(*you will be contacted*)</p>
         </div>
            <a href='products.php' class='btn'>continue reserving</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($con, "SELECT * FROM cart");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            
      ?>
      <span><?= $fetch_cart['descriptionland']; ?>(<?= $fetch_cart['location']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
   
      }
      ?>
   
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
        
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="easytopoimage/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444">
                </div>

        
         <div class="inputBox">
            <span>telephone</span>
            <input type="tel" placeholder="e.g. 671343867" name="telephone" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
        
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. cameroon" name="country" required>
         </div>
         
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="script.js"></script>
   
</body>
</html>