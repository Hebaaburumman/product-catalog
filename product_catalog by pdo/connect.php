<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_cataloge";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Set the character set to utf8
    $conn->exec("SET NAMES 'utf8'");
    
    // You can use this $conn PDO object for your further database operations
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>
