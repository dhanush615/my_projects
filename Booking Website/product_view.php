<?php
session_start();

if (!isset($_GET['product_id'])) {
    header("Location: index.php");
    exit();
}

$productId = $_GET['product_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adv_shopping_cart";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details from the database
$sql = "SELECT * FROM products WHERE id = $productId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productDetails = $result->fetch_assoc();
} else {
    echo "Product not found";
    exit();
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product View</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php require_once("inc/header.php"); ?>
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Product Details
                </div>
                <div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $productDetails['img_path']; ?>" alt="Product Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h5 class="card-title"><?php echo $productDetails['name']; ?></h5>
            <p class="card-text"><?php echo $productDetails['description']; ?></p>
            <p class="card-text">Price: Rs.<?php echo $productDetails['current_price']; ?></p>
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $productDetails['id']; ?>">
              
                            <button type=\"submit\" class=\"btn btn-primary my-3 rounded-0\" name=\"add\"><i class=\"fa fa-cart-plus\"> Add to Cart</i></button>
                             <input type='hidden' name='product_id' value='{$product_details['id']}'>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
<style>
@media screen and (max-width: 768px) {
    img {width:6cm;
        height: 5cm;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>