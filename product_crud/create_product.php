
<?php

// Include database connection
include "connect.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    // Retrieve form data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;
    $category = isset($_POST['category']) ? htmlspecialchars($_POST['category']) : '';

    // File upload handling
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

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO product (name, image, description, price, category) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssds", $name, $img, $description, $price, $category);

            // Execute the query
            if ($stmt->execute()) {
                echo "Product added successfully";
            } else {
                echo "Error adding product: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        // If no image is uploaded, set $img to null or handle as needed
        $img = null;
        echo "No image uploaded.";
    }
} else {
    echo "Form not submitted or 'add' parameter not set.";
}

header("Location: admin).php");
exit;

?>




?>