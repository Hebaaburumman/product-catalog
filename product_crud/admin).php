<?php
include "connect.php"; 
// Fetch product data from the database
$sql = "SELECT id, name, image, description, price, category FROM product";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link rel="stylesheet" href="style.css">

<style>
</style>
<script>
    $(document).ready(function () {
        // Listen for a click on the edit icon
        $('.edit').on('click', function () {
            var productId = $(this).data('product-id');

            // Assuming you have an endpoint to fetch product data by ID (replace with your actual endpoint)
            var apiUrl = 'api/getProductById.php?id=' + productId;

            // Fetch product data using AJAX
            $.get(apiUrl, function (data) {
                // Parse the JSON data received from the server
                var product = JSON.parse(data);

                // Populate the form fields with the fetched data
                $('#editProductModal #editProductId').val(id);
                $('#editProductModal #editName').val(name);
                $('#editProductModal #editDescription').val(description);
                $('#editProductModal #editPrice').val(price);
                $('#editProductModal #editCategory').val(category);

                // Open the modal
                $('#editProductModal').modal('show');
            });
        });
    });

$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
    function openDeleteModal(productId) {
        // Set the value of the hidden input field in the modal
        document.getElementById('deleteProductModalProductId').value = productId;

        // Open the modal
        $('#deleteProductModal').modal('show');
    }
</script>

</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
                   <div class="col-sm-6">
						<h2>Manage <b>products</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addproduct" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New product</span></a>
                        <a href='product_view.php' class='btn btn mr-2'>cataloge</a>
                   <!-- <a href="deleteProductModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td><img src='../src/{$row['image']}' alt='Product Image' style='max-width: 100px;'></td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td>{$row['price']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td> ";    

                   echo "<a href='edit.php?id={$row['id']}' class='btn btn-primary mr-2'>Edit</a>";

                   echo "<a href='#deleteProductModel;' class='btn btn-danger mr-2' onclick='confirmDelete({$row['id']})'>Delete</a>";
                   echo "<script>
                   function confirmDelete(productId) {
                   var result = confirm('Are you sure you want to delete this product?');

                   if (result) {
                   // If the user clicks 'OK', redirect to delete_product.php with the product ID
                  window.location.href = 'delete_product.php?id=' + productId;
                   } else {
                   // If the user clicks 'Cancel', do nothing or handle it as needed
                   }
                 }
                 </script>";

                 echo "</a>";
                 echo "</td>";

                 echo "</tr>";
                  }
                   ?>
                
					</tr> 
				</tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- add Modal HTML -->
<div id="addproduct" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="create_product.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">                        
                    <h4 class="modal-title">Add product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>price</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>    
                    <div class="form-group">
                        <label>category</label>
                        <select class="category" name="category"> 
                            <option value="Select">Select</option>
                            <option value="mobiles">Mobiles</option>
                            <option value="accessories">Accessories</option>
                        </select>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit"  name="add" class="btn btn-success">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="editProductModel" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProductForm" action="update_product.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Populate form fields with JavaScript -->
                    <script>
                    // JavaScript to set the values of form fields with product data
                   $(document).on("show.bs.modal", "#editProductModel", function () {
                   var productData = <?php echo json_encode($product); ?>;

                   // Set the values of form fields
                   $('#editProductForm input[name="name"]').val(productData.name);
                   $('#editProductForm textarea[name="description"]').val(productData.description);
                   $('#editProductForm input[name="price"]').val(productData.price);
                   $('#editProductForm select[name="category"]').val(productData.category);
        
                   // Set the value of the hidden input field for product ID
                   $('#editProductForm input[name="id"]').val(productData.id);
                     });
                  </script>

                    <!-- Form fields -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category">
                            <option value="mobiles">Mobiles</option>
                            <option value="accessories">Accessories</option>
                        </select>
                    </div>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="submit" name="update" class="btn btn-success">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
        

<!-- Delete Modal HTML -->
<!-- <div id="deleteProductModal" class="modal fade">
<div class="modal-dialog">
        <div class="modal-content">
            <form action="delete_product.php" method="post">
                <div class="modal-header">                        
                    <h4 class="modal-title">Delete product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                    <!-- Include the product ID as a hidden input field --> -->
                  <!-- <input type="hidden" name="product_id" value="echo $product['id']; ">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>  -->
<!-- </div> --> -->


</body>
</html>