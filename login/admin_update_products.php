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
	<title>Update Products | Admin Panel</title>
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

	<?php

		if($_GET['pro_id']==null)
		{
			echo("<h1 style='text-align: center; color: red;'>Error 404</h1>");
			exit();
		}

	?>

	<?php

		$query = "SELECT * FROM `products` WHERE `product_id` = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$_GET['pro_id']]);

		$name="";
		$desc="";
		$price="";
		$quan="";
		$cat_id="";
		$brand_id="";
		$img_1="";

		if($stmt->execute())
		{
			while($row = $stmt->fetch())
			{
				$name = $row['product_title'];
				$desc = $row['product_desc'];
				$price = $row['product_price'];
				$quan = $row['quantity'];
				$cat_id = $row['cat_id'];
				$brand_id = $row['brand_id'];
				$img_1 = $row['product_img1'];
			}
		}

	?>

	<br>

	<h3 style="text-align: center;">Update Products</h3><br><br>

	<div class="main-div-update" style="text-align: center;">
		<div class="inner-div-update" style="display: inline-block;">
			
			<form method="post" enctype="multipart/form-data" id="pro-form" onsubmit="return validate_pro_updation();">

	            			<input type="hidden" name="size" value="1000000">

	            			<div class="form-group">
							    <label for="brand-name">Product Name:</label>
							    <input type="text" class="form-control" id="product-name" maxlength="100" name="product_name" value="<?= $name ?>">
							</div>
							<p class="err-product" id="pro-name-error" style="color: red;"></p>

							<div class="form-group">
							    <label for="brand-description">Product Image:</label><br>
							    <?php

							    	echo("<img style='width: 300px; height: 200px;' src='images/product_images/".$img_1."'>");

							    ?>
						    </div>

							<div class="form-group">
							    <label for="brand-description">Product Description:</label>
							    <textarea type="text" class="form-control" id="product-desc" maxlength="500" rows="10" cols="10" name="product_desc"><?php echo($desc) ?></textarea>
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

							    			if($row['brand_id']==$brand_id)
							    			{
							    				echo("

							    					<option selected='selected' value='".$row['brand_id']."'>".$row['brand_title']."</option>

							    				");
							    			}

							    			else
							    			{
							    				echo("

							    					<option value='".$row['brand_id']."'>".$row['brand_title']."</option>

							    				");
							    			}
							    			
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

							    			if($row['cat_id']==$cat_id)
							    			{
							    				echo("

						    					<option selected='selected' value='".$row['cat_id']."'>".$row['cat_title']."</option>

							    				");
							    			}

							    			else
							    			{
						    					echo("

						    					<option value='".$row['cat_id']."'>".$row['cat_title']."</option>

							    				");
							    			}
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
							    <input type="number" class="form-control" id="product-price" name="product_price" min="0" value="<?= $price ?>">
						    </div>
						    <p class="err-product" id="pro-price-error" style="color: red;"></p>

						    <div class="form-group">
							    <label for="brand-description">Quantity:</label>
							    <input type="number" class="form-control" id="product-quan" name="product_quan" min="1" value="<?= $quan ?>">
						    </div>
						    <p class="err-product" id="pro-quan-error" style="color: red;"></p>

						    <div class="form-group">
						    	<button class="btn btn-success" name="update_pro" id="update-pro">Update Product</button>
						    </div>

	            		</form>

		</div>
	</div>


	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		// Function for front-end validation of product updation
		function validate_pro_updation()
		{
		    var title         = document.getElementById('product-name').value;
		    var desc          = document.getElementById('product-desc').value;
		    var brand         = document.getElementById('select-brand-for-product').value;
		    var cat           = document.getElementById('select-category-for-product').value;
		    var product_img1  = document.getElementById('product-img1').files;
		    var product_img2  = document.getElementById('product-img2').files;
		    var product_img3  = document.getElementById('product-img3').files;
		    var product_price = document.getElementById('product-price').value;
		    var quantity      = document.getElementById('product-quan').value;

		    var title_length  = title.length;
		    var desc_length   = desc.length;
		    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]/;

		    var validation;

		    if(title_length<1)
		    {
		        var pro_error = document.getElementById('pro-name-error');
		        pro_error.innerHTML = "Please fill the product name field";
		        pro_error.display = "block";
		        validation = false;
		    }

		    else if(title_length>100)
		    {
		        var pro_error = document.getElementById('pro-name-error');
		        pro_error.innerHTML = "Product name field limit exceeded";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(desc_length<1)
		    {
		        var pro_error = document.getElementById('pro-desc-error');
		        pro_error.innerHTML = "Please fill the product description field";
		        pro_error.display = "block";
		        validation = false;
		    }


		    else if(desc_length>500)
		    {
		        var pro_error = document.getElementById('pro-desc-error');
		        pro_error.innerHTML = "Product name field limit exceeded";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(brand == "null")
		    {
		        var pro_error = document.getElementById('pro-brands-error');
		        pro_error.innerHTML = "Please select a brand";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(cat== "null")
		    {
		        var pro_error = document.getElementById('pro-cats-error');
		        pro_error.innerHTML = "Please select a category";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(product_img1.length == 0)
		    {
		        var pro_error = document.getElementById('pro-img1-error');
		        pro_error.innerHTML = "Please select an image";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(product_img2.length == 0)
		    {
		        var pro_error = document.getElementById('pro-img2-error');
		        pro_error.innerHTML = "Please select an image";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(product_img3.length == 0)
		    {
		        var pro_error = document.getElementById('pro-img3-error');
		        pro_error.innerHTML = "Please select an image";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(product_price<0)
		    {
		        var pro_error = document.getElementById('pro-price-error');
		        pro_error.innerHTML = "Price cannot be less than zero";
		        pro_error.display = "block";
		        validation = false;
		    }

		    else if(product_price.length == 0)
		    {
		        var pro_error = document.getElementById('pro-price-error');
		        pro_error.innerHTML = "Please fill the price input";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(quantity<1)
		    {
		        var pro_error = document.getElementById('pro-quan-error');
		        pro_error.innerHTML = "Quantity cannot be less than 1";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(quantity.length == 0)
		    {
		        var pro_error = document.getElementById('pro-quan-error');
		        pro_error.innerHTML = "Please fill the quantity input";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(format.test(title))
		    {
		        var pro_error = document.getElementById('pro-name-error');
		        pro_error.innerHTML = "Title cannot contain special characters";
		        pro_error.display = "block";
		        validation = false;
		    }

		    if(format.test(desc))
		    {
		        var pro_error = document.getElementById('pro-desc-error');
		        pro_error.innerHTML = "Description cannot contain special characters";
		        pro_error.display = "block";
		        validation = false;
		    }

		    return validation;
		}

	</script>

	<?php

		include('includes/update_things.php');

		$update = new Update();

		// if(isset($_POST['update_pro']))
		// {
		// 	if($update->check_cat($_POST['cat_name'], $_POST['cat_desc']))
		// 	{
		// 		$update->update_cat($_GET['cat_id'], $_POST['cat_name'], $_POST['cat_desc']);
		// 	}
		// }
	?>

</body>
</html>