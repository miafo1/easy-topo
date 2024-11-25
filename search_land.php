<?php
include('config/dbcon.php');

if (isset($_POST['add_to_cart'])) {
    $product_description = $_POST['product_description'];
    $product_image = $_POST['product_image'];
    $product_location = $_POST['product_location'];

    $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE descriptionland = '$product_description'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        $insert_product = mysqli_query($con, "INSERT INTO cart (location, descriptionland, image) VALUES('$product_location', '$product_description', '$product_image')");
        $message[] = 'Product added to cart successfully';
    }
}

$search_results = [];
if (isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];

    // Call the Python script for NLP processing
    $command = escapeshellcmd("python3 search_land.py \"$search_query\"");
    $output = shell_exec($command);

    // Convert the JSON output to an array
    $search_results = json_decode($output, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="heading">Search Results</h1>
    <div class="row">

        <?php
        if (!empty($search_results)) {
            foreach ($search_results as $land) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="uploads/posts/<?php echo $land['imageland']; ?>" class="card-img-top" alt="Land Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $land['titleland']; ?></h5>
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#details<?php echo $land['idland']; ?>">Details</button>
                            <div id="details<?php echo $land['idland']; ?>" class="collapse mt-2">
                                <p><strong>District:</strong> <?php echo $land['districtname']; ?></p>
                                <p><strong>Description:</strong> <?php echo $land['descriptionland']; ?></p>
                                <p><strong>Unit Price:</strong> <?php echo $land['unitprice']; ?>fr</p>
                                <p><strong>Total Price:</strong> <?php echo $land['totalprice']; ?>fr</p>
                                <p><strong>Land Type:</strong> <?php echo $land['land_type']; ?></p>
                                <p><strong>Purpose:</strong> <?php echo $land['land_purpose']; ?></p>
                            </div>
                            <form action="" method="post" class="mt-3">
                                <input type="hidden" name="product_description" value="<?php echo $land['descriptionland']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $land['imageland']; ?>">
                                <input type="hidden" name="product_location" value="<?php echo $land['locationland']; ?>">
                                <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-12 text-center"><h2>No land found matching your criteria</h2></div>';
        }
        ?>

    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>