<?php
// Include database connection
include "connect.php";

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $d="DELETE FROM product WHERE id=$id";
    $conn->query($d);
} else {
    echo "Product ID not provided in the URL. Please provide a valid product ID.";
}
header("Location: admin).php");
        exit();
?>
