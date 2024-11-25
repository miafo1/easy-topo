<?php
session_start();

include('config/dbcon.php');

$town_id = isset($_GET['town_id']) ? $_GET['town_id'] : 0;

if (isset($_POST['add_to_cart'])) {
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];
    $product_location = $_POST['product_location'];
    $land_id = $_POST['land_id']; // Get the land ID

    $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE descriptionland = '$product_description'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        // Include land_id in the INSERT statement
        $insert_product = mysqli_query($con, "INSERT INTO cart (location, descriptionland, image, land_id) VALUES('$product_location', '$product_description', '$product_image', '$land_id')");
        $message[] = 'Product added to cart successfully';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lands Available</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">' . $message . 
             '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             </div>';
    }
}

include 'header.php';
?>

<div class="container mt-4">
    <section class="products">
        <h1 class="heading">Available Land</h1>
        <div class="row">

            <?php
            $select_products = mysqli_query($con, "SELECT * FROM land WHERE idtown = '$town_id'");
            
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="uploads/posts/<?php echo $fetch_product['imageland']; ?>" class="card-img-top" alt="Land Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $fetch_product['titleland']; ?></h5>
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#details<?php echo $fetch_product['idland']; ?>">Details</button>
                                <div id="details<?php echo $fetch_product['idland']; ?>" class="collapse mt-2">
                                    <p><strong>District:</strong> <?php echo isset($fetch_product['districtname']) ? $fetch_product['districtname'] : 'N/A'; ?></p>
                                    <p><strong>Description:</strong> <?php echo isset($fetch_product['descriptionland']) ? $fetch_product['descriptionland'] : 'N/A'; ?></p>
                                    <p><strong>Unit Price:</strong> <?php echo isset($fetch_product['unitprice']) ? $fetch_product['unitprice'] : 'N/A'; ?>fr</p>
                                    <p><strong>Total Price:</strong> <?php echo isset($fetch_product['totalprice']) ? $fetch_product['totalprice'] : 'N/A'; ?>fr</p>
                                </div>
                                <form action="" method="post" class="mt-3">
                                        <input type="hidden" name="product_description" value="<?php echo $fetch_product['descriptionland']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['imageland']; ?>">
                                        <input type="hidden" name="product_location" value="<?php echo $fetch_product['locationland']; ?>">
                                        <input type="hidden" name="land_id" value="<?php echo $fetch_product['idland']; ?>"> <!-- Add this line -->
                                        <?php if($fetch_product['statusland'] == 'reserved'){ ?>
                                            <span class="reserved" style="color:green;">THIS ARTICLE IS ON RESERVED</span>
                                            <button class="btn" disabled style="color:darkgoldenrod;">Reserved</button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                                        <?php } ?>
                                    </form>

                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center"><h2>No Land Available in this Town</h2></div>';
            }
            ?>

        </div>
    </section>
</div>

<!-- jQuery and Bootstrap JS for collapse functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Custom JS File Link -->
<script src="script.js"></script>

</body>
</html>
