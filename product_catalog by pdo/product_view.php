<?php

// Include database connection
include "connect.php";

// Initialize variables
$backButton = false;
$searchResults = [];

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch product data from the database using prepared statement
    $stmtAll = $pdo->prepare("SELECT id, name, image, description, price, category FROM product");
    $stmtAll->execute();

    // Fetch all products as an associative array
    $allProducts = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name'])) {
        $search = $_GET['name'];

        // Validate and sanitize the input to prevent SQL injection
        $search = htmlspecialchars($search);

        // Use prepared statement to prevent SQL injection
        $stmtSearch = $pdo->prepare("SELECT id, name, image, description, price, category FROM product WHERE name LIKE :search");
        $stmtSearch->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmtSearch->execute();

        // Fetch the search results as an associative array
        $searchResults = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are any results
        if (count($searchResults) > 0) {
            $backButton = false;
        } else {
            // Set the variable to display the back button
            $backButton = true;
        }
    }
} catch (PDOException $e) {
    // Handle the PDO exception
    echo 'Error executing the query: ' . $e->getMessage();
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Corrected inclusion of Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <style>
     @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');html, body{height: 100%}body{display: grid;background: #fff;font-family: 'Manrope', sans-serif}.mydiv{margin-top: 50px;margin-bottom: 50px}.cross{font-size:10px}.padding-0{padding-right: 5px;padding-left: 5px}.img-style{margin-left: -11px;box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);border-radius: 5px;max-width: 104% !important}.m-t-20{margin-top: 20px}.bbb_background{background-color: #E0E0E0 !important}.ribbon{width: 150px;height: 150px;overflow: hidden;position: absolute}.ribbon span{position: absolute;display: block;width: 34px;border-radius: 50%;padding: 8px 0;background-color: #3498db;box-shadow: 0 5px 10px rgba(0, 0, 0, .1);color: #fff;font: 100 18px/1 'Lato', sans-serif;text-shadow: 0 1px 1px rgba(0, 0, 0, .2);text-transform: uppercase;text-align: center}.ribbon-top-right{top: -10px;right: -10px}.ribbon-top-right::before, .ribbon-top-right::after{border-top-color: transparent;border-right-color: transparent}.ribbon-top-right::before{top: 0;left: 17px}.ribbon-top-right::after{bottom: 17px;right: 0}.sold_stars i{color: orange}.ribbon-top-right span{right: 17px;top: 17px}div{display: block;position: relative;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box}.bbb_deals_featured{width: 100%}.bbb_deals{width: 100%;margin-right: 7%;padding-top: 80px;padding-left: 25px;padding-right: 25px;padding-bottom: 34px;box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);border-radius: 5px;margin-top: 0px}.bbb_deals_title{position: absolute;top: 10px;left: 22px;font-size: 18px;font-weight: 500;color: #000000}.bbb_deals_slider_container{width: 100%}.bbb_deals_item{width: 100% !important}.bbb_deals_image{width: 100%}.bbb_deals_image img{width: 100%}.bbb_deals_content{margin-top: 33px}.bbb_deals_item_category a{font-size: 14px;font-weight: 400;color: rgba(0, 0, 0, 0.5)}.bbb_deals_item_price_a{font-size: 14px;font-weight: 400;color: rgba(0, 0, 0, 0.6)}.bbb_deals_item_price_a strike{color: red}.bbb_deals_item_name{font-size: 24px;font-weight: 400;color: #000000}.bbb_deals_item_price{font-size: 24px;font-weight: 500;color: #6d6e73}.available{margin-top: 19px}.available_title{font-size: 16px;color: rgba(0, 0, 0, 0.5);font-weight: 400}.available_title span{font-weight: 700}@media only screen and (max-width: 991px){.bbb_deals{width: 100%;margin-right: 0px}}@media only screen and (max-width: 575px){.bbb_deals{padding-left: 15px;padding-right: 15px}.bbb_deals_title{left: 15px;font-size: 16px}.bbb_deals_slider_nav_container{right: 5px}.bbb_deals_item_name, .bbb_deals_item_price{font-size: 20px}}

   </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">mobiles & more</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admin).php">admin<span class="sr-only"></span></a>
            </li>
        </ul>

        <form action="" method="get" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="name">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <?php
   

    // // Display back button
    if ($backButton) {
    echo '<button  class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="goBack()">Go Back</button>';
    echo '<br>';
    echo '<br>' .' no result found';
    }
    ?>
    <script>
    function goBack() {
        // Redirect to product_view.php
        window.location.href = 'product_view.php';
    }
</script> 
    </div>
</nav>

<div class="container mydiv">
    <div class="row">
        <?php
    include "connect.php";

// try {
//     // Create a new PDO instance
//     $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

//     // Set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// //     // Fetch product data from the database using prepared statement
//     $sql = "SELECT id, name, image, description, price, category FROM product";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute();

//     // Fetch the result as an associative array
//     $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     foreach ($products as $product) {

        
        // Display all products or search results
        $displayResults = count($searchResults) > 0 ? $searchResults : $allProducts;

        foreach ($displayResults as $product) {
        ?>
        
            <div class="col-md-4">
                <div class="bbb_deals">
                    <div class="bbb_deals_title"></div>
                    <div class="bbb_deals_slider_container">
                        <div class="bbb_deals_item">
                            <div class="bbb_deals_image">
                                <!-- Replace the static image URL with the dynamic image path from your database -->
                                <img src="../src/<?php echo $product['image']; ?>" alt="">
                            </div>
                            <div class="bbb_deals_content">
                                <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                    <!-- Replace the static category with the dynamic category from your database -->
                                    <div class="bbb_deals_item_category"><a href="#"><?php echo $product['category']; ?></a></div>
                                    <div class="bbb_deals_item_price_a ml-auto">
                                        <!-- Replace the static original price with the dynamic original price from your database -->
                                        <?php echo 'JD' . $product['price']; ?>
                                    </div>
                                </div>
                                <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                    <!-- Replace the static product name with the dynamic product name from your database -->
                                    <div class="bbb_deals_item_name"><?php echo $product['name']; ?></div>
                                </div>
                                <div class="description">
                                    <div class="available_line d-flex flex-row justify-content-start">
                                        <div class="available_title"> <span><?php echo $product['description']; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        //  } catch (PDOException $e) {
        //     echo "Error: " . $e->getMessage();
        //  }
        ?>
        
    </div>
</div>
    
</body>
</html>

