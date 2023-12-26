<?php

include "connect.php"; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Ensure the product ID is set and valid
    $product_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($product_id > 0) {
        // Retrieve updated data from the form
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
        $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;
        $category = isset($_POST['category']) ? htmlspecialchars($_POST['category']) : '';

        // Check if 'image' file is uploaded
        $imagePath = ''; // Initialize image path
        if (!empty($_FILES['image']['name'])) {
            $img_name = time() . '_' . $_FILES['image']['name'];
            $img_path = 'C:/xampp/htdocs/product/src/' . $img_name; // Update the path to your image directory
    
            // Check if the directory exists; if not, create it
            if (!file_exists('C:/xampp/htdocs/product/src/')) {
                mkdir('C:/xampp/htdocs/product/src/', 0777, true);
            }
    
            // Check if the file was successfully moved
            if (move_uploaded_file($_FILES['image']['tmp_name'], $img_path)) {
                // Add the image name to the database
                $img = $img_name;
            }
        }

        // Use prepared statement for update using PDO
        $sql = "UPDATE product SET name=?, image=?, description=?, price=?, category=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $img);
        $stmt->bindParam(3, $description);
        $stmt->bindParam(4, $price);
        $stmt->bindParam(5, $category);
        $stmt->bindParam(6, $product_id);

        // Execute the query
        if ($stmt->execute()) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product: " . $stmt->errorInfo()[2];
        }

        // Close the statement
        $stmt->closeCursor();
    } else {
        echo "Invalid product ID for update.";
    }
}

header("Location: admin).php");
exit();
?>
