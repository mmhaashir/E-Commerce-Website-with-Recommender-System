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
	<title>Add Page | Admin Panel</title>
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

	<!-- <img title="untitled-5.gif" src="https://cdn.dribbble.com/users/563824/screenshots/3633228/untitled-5.gif" alt="Untitled 5"> -->

	<!-- Heading -->
	<div class="container">
		<h2 class="admin-panel-heading">Add Products, Categories or Brands</h2>
	</div>

	<br><br>

	<!-- Main Area -->
	<div class="row" id="main-div">

		<!-- Row 1 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-success admin-session-button" data-toggle="modal" data-target="#add-a-product-modal">Add a Product</button>
		</div>

		<!-- Row 2 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-warning admin-session-button" data-toggle="modal" data-target="#add-a-category-modal">Add a Category</button>
		</div>

		<!-- Row 3 -->
		<div class="col-md-4 inner-main-div">
			<button class="btn btn-danger admin-session-button" data-toggle="modal" data-target="#add-a-brand-modal">Add a Brand</button>
		</div>

	</div>

	<!-- Modals -->

	<!-- Add a Product Modal -->
	<div id='add-a-product-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Add a Product</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<form method="post" enctype="multipart/form-data" id="pro-form" onsubmit="return validate_pro_submission();">

	            			<input type="hidden" name="size" value="1000000">

	            			<div class="form-group">
							    <label for="brand-name">Product Name:</label>
							    <input type="text" class="form-control" id="product-name" maxlength="100" name="product_name">
							</div>
							<p class="err-product" id="pro-name-error" style="color: red;"></p>

							<div class="form-group">
							    <label for="brand-description">Product Description:</label>
							    <textarea type="text" class="form-control" id="product-desc" maxlength="500" rows="10" cols="10" name="product_desc"></textarea>
						    </div>
						    <p class="err-product" id="pro-desc-error" style="color: red;"></p>

						    <div class="form-group">
							    <label for="brand-description">Brand:</label>
							    <select class="form-control" id="select-brand-for-product" name="pro_brand">
							    	<option value="null">Select a Brand</option>
							    <?php

							    	$query = "SELECT * FROM `brands`";
							    	$stmt = $db->prepare($query);

							    	if($stmt->execute())
							    	{
							    		while($row = $stmt->fetch())
							    		{
							    			echo("

							    					<option value='".$row['brand_id']."'>".$row['brand_title']."</option>

							    				");
							    		}
							    	}

							    ?>
								</select>
						    </div>
						    <p class="err-product" id="pro-brands-error" style="color: red;"></p>

						    <div class="form-group">
							    <label for="brand-description">Category:</label>
							    <select class="form-control" id="select-category-for-product" name="pro_cat">
							  		<option value="null">Select a Category</option>
							    <?php

							    	$query = "SELECT * FROM `categories`";
							    	$stmt = $db->prepare($query);

							    	if($stmt->execute())
							    	{
							    		while($row = $stmt->fetch())
							    		{
							    			echo("

							    					<option value='".$row['cat_id']."'>".$row['cat_title']."</option>

							    				");
							    		}
							    	}

							    ?>
								</select>
						    </div>
						    <p class="err-product" id="pro-cats-error" style="color: red;"></p>

						    <div class="form-group">
							    <label for="brand-name">Product Image 1:</label>
							    <input type="file" class="form-control" id="product-img1" name="product_img1">
							</div>
							<p class="err-product" id="pro-img1-error" style="color: red;"></p>

							<div class="form-group">
							    <label for="brand-name">Product Image 2:</label>
							    <input type="file" class="form-control" id="product-img2" name="product_img2">
							</div>
							<p class="err-product" id="pro-img2-error" style="color: red;"></p>

							<div class="form-group">
							    <label for="brand-name">Product Image 3:</label>
							    <input type="file" class="form-control" id="product-img3" name="product_img3">
							</div>
							<p class="err-product" id="pro-img3-error" style="color: red;"></p>

						    <div class="form-group">
							    <label for="brand-description">Product Price:</label>
							    <input type="number" class="form-control" id="product-price" name="product_price" min="0">
						    </div>
						    <p class="err-product" id="pro-price-error" style="color: red;"></p>

						    <div class="form-group">
							    <label for="brand-description">Quantity:</label>
							    <input type="number" class="form-control" id="product-quan" name="product_quan" min="1">
						    </div>
						    <p class="err-product" id="pro-quan-error" style="color: red;"></p>

						    <div class="form-group">
						    	<button class="btn btn-success" type="submit" name="add_pro" id="add-pro">Add Product</button>
						    </div>

	            		</form>

	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Add a Category Modal -->
	<div id='add-a-category-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Add a Category</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<form method="post" id="cat-form" onsubmit="return validate_cat_submission();">
	            			<div class="form-group">
							    <label for="brand-name">Category Name:</label>
							    <input type="text" class="form-control" id="cat-name" maxlength="100" name="cat_name">
							</div>
							<div class="form-group">
							    <label for="brand-description">Category Description:</label>
							    <textarea type="text" class="form-control" id="cat-desc" maxlength="500" rows="10" cols="10" name="cat_desc"></textarea>
						    </div>
						    <p id="cat-err"></p>
						    <div class="form-group">
						    	<button class="btn btn-success" name="add_cat" id="add-cat">Add Category</button>
						    </div>
	            		</form>
	            	</div>
	            </div>
	            <div class='modal-footer'>
	            	<button class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Add a Brand Modal -->
	<div id='add-a-brand-modal' class='modal fade' data-keyboard="false" data-backdrop="static">
	    <div class='modal-dialog'>
	        <div class='modal-content'>
	            <div class='modal-header'>
	                <h5 class='modal-title'>Add a Brand</h5>
	                <button type='button' class='close' data-dismiss='modal'>&times;</button>
	            </div>
	            <div class='modal-body'>
	            	<div class="modal-body-inner">
	            		<div class="modal-body-inner">
	            			<form method="post" onsubmit="return validate_brand_submission();">
	            				<div class="form-group">
								    <label for="brand-name">Brand Name:</label>
								    <input type="text" class="form-control" id="brand-name" maxlength="100" name="brand_name">
								</div>
								<div class="form-group">
								    <label for="brand-description">Brand Description:</label>
								    <textarea type="text" class="form-control" id="brand-desc" maxlength="500" rows="10" cols="10" name="brand_desc"></textarea>
							    </div>
							    <p id="brand-err" style="color: red;"></p>
							    <div class="form-group">
							    	<button class="btn btn-success" name="add_brand">Add Brand</button>
							    </div>
	            			</form>
	            		</div>
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

	<?php

		include("includes/add_things.php");

		$add = new Add();

		if(isset($_POST['add_pro']))
		{
			if($add->check_pro($_POST['product_name'], $_POST['product_desc'], $_POST['pro_brand'], $_POST['pro_cat'], $_POST['product_price'], $_POST['product_quan']))
			{
				$add->add_product($_POST['product_name'], $_POST['product_desc'], $_POST['pro_brand'], $_POST['pro_cat'], $_POST['product_price'], $_POST['product_quan']);
			}

			else
			{
				echo("Products not validated");
			}
		}

		if(isset($_POST['add_cat']))
		{
			if($add->check_cat($_POST['cat_name'], $_POST['cat_desc']))
			{
				$add->add_cat($_POST['cat_name'], $_POST['cat_desc']);	
			}

			else
			{
				echo ("Category not validated");
			}
		}

		if(isset($_POST['add_brand']))
		{
			if($add->check_brand($_POST['brand_name'], $_POST['brand_desc']))
			{
				$add->add_brand($_POST['brand_name'], $_POST['brand_desc']);	
			}

			else
			{
				echo("Brand not validated");
			}
		}

	?>


</body>
</html>