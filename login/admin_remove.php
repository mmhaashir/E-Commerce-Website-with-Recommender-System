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
	<title>Remove Page | Admin Panel</title>

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
		<h2 class="admin-panel-heading">Remove Products, Categories or Brands</h2>
	</div>

	<br><br>


	<!-- Main Area -->
	<div class="row" id="main-div">

		<!-- Row 1 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-success admin-session-button" data-toggle="modal" data-target="#remove-a-product-modal">Remove a Product</button>
		</div>

		<!-- Row 2 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-warning admin-session-button" data-toggle="modal" data-target="#remove-a-category-modal">Remove a Category</button>
		</div>

		<!-- Row 3 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-danger admin-session-button" data-toggle="modal" data-target="#remove-a-brand-modal">Remove a Brand</button>
		</div>

	</div>

	<!-- Modals -->

	<!-- Remove a Product Modal -->
	<div id='remove-a-product-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Remove a Product</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<div class="modal-body-inner">

	            			<form method="post">
	            				<table class="table">

		            				<tr>
		            					<td><h5>Select</h5></td>
		            					<td><h5>Product Name</h5></td>
		            					<td><h5>Image</h5></td>
		            					<td><h5>Price</h5></td>
		            				</tr>


		            				<?php
		            					$query = "SELECT * FROM `products`";
		            					$stmt = $db->prepare($query);

		            					if($stmt->execute())
		            					{
		            						while($row = $stmt->fetch())
		            						{
		            							echo("

		            									<tr>

		            										<td><input type='checkbox' value='".$row['product_id']."' class='pro-remove-err' name='products[]'></input></td>
		            										<td>".$row['product_title']."</td>
		            										<td><img style='width: 50px; height: 50px;' src='images/product_images/".$row['product_img1']."'></td>
		            										<td>".$row['product_price']."</td>

		            									</tr>


		            								");
		            						}
		            					}

		            				?>

		            			</table>

		            			<p style="display: none; color: red;" id="pro-remove-err"></p>

		            			<div class="form-group">
								    <button class="btn btn-success" name="remove_products">Remove Product(s)</button>
								</div>
	            			</form>
	            			
	            		</div>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Remove a Category Modal -->
	<div id='remove-a-category-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Remove a Category</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<div class="modal-body-inner">

	            			<form onsubmit="return validate_cat_removal()" method="post">
	            				<table class="table">

		            				<tr>
		            					<td><h5>Select</h5></td>
		            					<td><h5>Category Name</h5></td>
		            					<td><h5>Description</h5></td>
		            				</tr>


		            				<?php

		            					$query = "SELECT * FROM `categories`";
		            					$stmt = $db->prepare($query);

		            					if($stmt->execute())
		            					{
		            						while($row = $stmt->fetch())
		            						{
		            							echo("

		            									<tr>

		            										<td><input type='checkbox' value='".$row['cat_id']."' class='cat-remove-checkbox' name='cats[]'></input></td>
		            										<td>".$row['cat_title']."</td>
		            										<td>".$row['cat_desc']."</td>

		            									</tr>


		            								");
		            						}
		            					}

		            				?>

		            			</table>

		            			<p style="display: none; color: red;" id="cat-remove-err"></p>

		            			<div class="form-group">
								    <button class="btn btn-success" name="remove_cats">Remove Category(s)</button>
								</div>
	            			</form>

	            			
	            		</div>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Remove a Brand Modal -->
	<div id='remove-a-brand-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Remove a Brand</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<div class="modal-body-inner">

	            			<form onsubmit = "return validate_brand_removal();" method="post">
	            				<table class="table">

		            				<tr>
		            					<td><h5>Select</h5></td>
		            					<td><h5>Brand Name</h5></td>
		            					<td><h5>Description</h5></td>
		            				</tr>


		            				<?php

		            					$query = "SELECT * FROM `brands`";
		            					$stmt = $db->prepare($query);

		            					if($stmt->execute())
		            					{
		            						while($row = $stmt->fetch())
		            						{
		            							echo("

		            									<tr>

		            										<td><input type='checkbox' value='".$row['brand_id']."' name='brands[]' class='brand-remove-checkbox'></input></td>
		            										<td>".$row['brand_title']."</td>
		            										<td>".$row['brand_desc']."</td>

		            									</tr>


		            								");
		            						}
		            					}

		            				?>

		            			</table>

		            			<p style="display: none; color: red;" id="brand-remove-err"></p>

		            			<div class="form-group">
								    <button class="btn btn-success" name="remove_brands" type="submit">Remove Brand(s)</button>
								</div>
	            			</form>
	            			
	            		</div>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<?php

		include("includes/remove_things.php");

		$remove = new Remove();

		if(isset($_POST['remove_products']))
		{
			if($remove->check_products_removal($_POST['products']))
			{
				$remove->remove_pro($_POST['products']);
			}

		}

		if(isset($_POST['remove_cats']))
		{
			if($remove->check_categories_removal($_POST['cats']))
			{
				$remove->remove_cats($_POST['cats']);
			}
		}

		if(isset($_POST['remove_brands']))
		{
			if($remove->check_brands_removal($_POST['brands']))
			{
				$remove->remove_brands($_POST['cats']);
			}
		}

	?>

</body>
</html>