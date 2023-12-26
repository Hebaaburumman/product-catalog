<?php
// Include database connection
include "connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM product WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error deleting product: " . $e->getMessage();
    } finally {
        // Close the statement
        $stmt->closeCursor();
    }
} else {
    echo "Product ID not provided in the URL. Please provide a valid product ID.";
}

header("Location: admin).php"); // Corrected the redirection URL
exit();
?>


