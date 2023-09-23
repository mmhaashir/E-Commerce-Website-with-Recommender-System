<?php

	include("includes/session.php");
	include("includes/db.php");

	if(!isset($_SESSION["admin"]))
	{
		header("Location: index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Page | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
	<link rel="stylesheet" type="text/css" href="css/my.css">

	<script type="text/javascript">
		if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
</head>
<body>

	<br>

	<!-- Heading -->
	<div class="container">
		<h2 class="admin-panel-heading">Update Products, Categories or Brands</h2>
	</div>

	<br><br>

	<!-- Main Area -->
	<div class="row" id="main-div">

		<!-- Row 1 -->
		<!-- <div class="col-md-4 inner-main-div">
			<button class="btn btn-success admin-session-button" data-toggle="modal" data-target="#update-a-product-modal">Update a Product</button>
		</div> -->

		<!-- Row 2 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-warning admin-session-button" data-toggle="modal" data-target="#update-a-category-modal">Update a Category</button>
		</div>

		<!-- Row 3 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-danger admin-session-button" data-toggle="modal" data-target="#update-a-brand-modal">Update a Brand</button>
		</div>

	</div>

	<!-- Update a Product Modal -->
	<div id='update-a-product-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Update a Product</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<form method="post">
	            			<table class="table">

	            				<tr>
	            					<td><h5>Product Name</h5></td>
	            					<td><h5>Description</h5></td>
	            					<td><h5>Update</h5></td>
	            				</tr>

	            				<?php

	            					$query = "SELECT * FROM `products`";
	            					$stmt = $db->prepare($query);

	            					if($stmt->execute())
	            					{
	            						while($row = $stmt->fetch())
	            						{
	            							echo("<tr>

	            									<td>".$row['product_title']."</td>
	            									<td>".$row['product_desc']."</td>
	            									<td><a href='admin_update_products.php?pro_id=".$row['product_id']."' target='blank'><input type='button' class='btn btn-success' value='Update'></a></td>

	            								</tr>");
	            						}
	            					}

	            				?>

	            			</table>
	            		</form>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Update a Category Modal -->
	<div id='update-a-category-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Update a Category</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<form method="post">
	            			<table class="table">

	            				<tr>
	            					<td><h5>Category Name</h5></td>
	            					<td><h5>Description</h5></td>
	            					<td><h5>Update</h5></td>
	            				</tr>

	            				<?php

	            					$query = "SELECT * FROM `categories`";
	            					$stmt = $db->prepare($query);

	            					if($stmt->execute())
	            					{
	            						while($row = $stmt->fetch())
	            						{
	            							echo("<tr>

	            									<td>".$row['cat_title']."</td>
	            									<td>".$row['cat_desc']."</td>
	            									<td><a href='admin_update_cat.php?cat_id=".$row['cat_id']."' target='blank'><input type='button' class='btn btn-success' value='Update'></a></td>

	            								</tr>");
	            						}
	            					}

	            				?>

	            			</table>
	            		</form>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Update a Brand Modal -->
	<div id='update-a-brand-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Update a Brand</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<form method="post">
	            			<table class="table">

	            				<tr>
	            					<td><h5>Brand Name</h5></td>
	            					<td><h5>Description</h5></td>
	            					<td><h5>Update</h5></td>
	            				</tr>

	            				<?php

	            					$query = "SELECT * FROM `brands`";
	            					$stmt = $db->prepare($query);

	            					if($stmt->execute())
	            					{
	            						while($row = $stmt->fetch())
	            						{
	            							echo("<tr>

	            									<td>".$row['brand_title']."</td>
	            									<td>".$row['brand_desc']."</td>
	            									<td><a href='admin_update_brands.php?brand_id=".$row['brand_id']."' target='blank'><input type='button' class='btn btn-success' value='Update'></a></td>

	            								</tr>");
	            						}
	            					}

	            				?>

	            			</table>
	            		</form>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>



	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>