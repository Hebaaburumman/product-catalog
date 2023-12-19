
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">
                    <?php
                    
                    // Include database connection
                    include "connect.php";
                    // Retrieve product ID from the URL
                    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    
                    $sql = "SELECT * FROM  product WHERE id=$product_id ";
                    $result=$conn->query($sql);
                    $product = $result->fetch_assoc();

                    if ($product_id > 0) {
                        // Fetch product data from your database using $product_id
                        // Example data (replace this with actual data retrieval)
                       
                    } else {
                        echo "Invalid product ID.";
                        exit;
                    }
                    ?>

                    <form action="update_product.php" method="post" enctype="multipart/form-data">
                        <!-- Hidden input field for product ID -->
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            <small class="form-text text-muted">Leave empty to keep the existing image.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="mobiles" <?php echo ($product['category'] == 'mobiles') ? 'selected' : ''; ?>>mobiles</option>
                                <option value="accessories" <?php echo ($product['category'] == 'accessories') ? 'selected' : ''; ?>>accessories</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
