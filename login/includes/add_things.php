<!-- Adding Categories, Brands and Products to the Database -->

<?php

	include("db.php");

	class Add
	{
		
		// Function for backend category check
		function check_cat($title, $desc)
		{

			global $db;

			// Variable for checking validity
			$validate = true;

			// Getting Brand Category Name from Table
			$query = "SELECT * FROM `categories` WHERE `cat_title` = ?";
			$stmt = $db->prepare($query);
			$stmt->execute([$title]);

			if(($stmt->rowCount()) > 0)
			{
				$validate = false;

				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: red;'>Error</h5>
						            </div>
						            <div class='modal-body'>
						                <p>Category Already Present.</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");

			}

			// If any of field is empty, validation is cancelled
			else if(strlen($title)<1 || strlen($desc)<1)
			{
				$vaildate = false;
			}

			else if(strlen($title)>100 || strlen($desc)>500)
			{
				$validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $title))
			{
			    $validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $desc))
			{
			    $validate = false;
			}

			else
			{
				$validate = true;
			}

			return $validate;
		}

		// Function for sending caregory to database
		function add_cat($title, $desc)
		{
			global $db;

			$query = "INSERT INTO `categories`(`cat_title`, `cat_desc`) VALUES (:cat_title, :cat_desc)";
			$stmt = $db->prepare($query);
			$stmt->bindParam(":cat_title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":cat_desc", $desc, PDO::PARAM_STR);

			if($stmt->execute())
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Congratulations</h5>
						     
						            </div>
						            <div class='modal-body'>
						                <p>Category Added Successfully</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' data-toggle='modal' data-target='#add-a-category-modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");
			}

			else
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Oops</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>There was some issue adding category. Kindly contact the developer</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' data-toggle='modal' data-target='#add-a-category-modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");
			}
		}

		// Function for backend validation of brands
		function check_brand($title, $desc)
		{
			global $db;

			// Variable for checking validity
			$validate = true;

			// Getting Brand Category Name from Table
			$query = "SELECT * FROM `brands` WHERE `brand_title` = ?";
			$stmt = $db->prepare($query);
			$stmt->execute([$title]);

			if(($stmt->rowCount()) > 0)
			{
				$validate = false;

				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: red;'>Error</h5>
						    
						            </div>
						            <div class='modal-body'>
						                <p>Brand Already Present.</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");

			}


			// If any of field is empty, validation is cancelled
			else if(strlen($title)<1 || strlen($desc)<1)
			{
				$vaildate = false;
			}

			else if(strlen($title)>100 || strlen($desc)>500)
			{
				$validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $title))
			{
			    $validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $desc))
			{
			    $validate = false;
			}

			else
			{
				$validate = true;
			}

			return $validate;
		}

		// Function for sending brand to database
		function add_brand($title, $desc)
		{
			global $db;

			$query = "INSERT INTO `brands`(`brand_title`, `brand_desc`) VALUES (:brand_title, :brand_desc)";
			$stmt = $db->prepare($query);
			$stmt->bindParam(":brand_title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":brand_desc", $desc, PDO::PARAM_STR);

			if($stmt->execute())
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Congratulations</h5>
						               
						            </div>
						            <div class='modal-body'>
						                <p>Brand Added Successfully</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' data-toggle='modal' data-target='#add-a-brand-modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");
			}

			else
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Oops</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>There was some issue adding brand. Kindly contact the developer</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' data-toggle='modal' data-target='#add-a-brand-modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");
			}
		}

		function check_pro($pro_name, $pro_desc, $pro_brand, $pro_cat, $pro_price, $pro_quan)
		{
			global $db;

			// Variable for checking validity
			$validate = true;

			// Getting Product Name from Table
			$query = "SELECT * FROM `products` WHERE `product_title` = ?";
			$stmt = $db->prepare($query);
			$stmt->execute([$pro_name]);

			if(($stmt->rowCount()) > 0)
			{
				$validate = false;

				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: red;'>Error</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>Product Already Present.</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");

			}

			if(strlen($pro_name)<1)
			{
				$validate = false;
				echo("Name not validated");
			}

			else if(strlen($pro_name)>100)
			{
				$validate = false;
				echo("Name not validated");
			}

			if(strlen($pro_desc)<1)
			{
				$validate = false;
				echo("Description not validated");
			}

			else if(strlen($pro_desc)>500)
			{
				$validate = false;
				echo("Description not validated");
			}

			if($pro_brand == "null")
			{
				$validate = false;
				echo("Brand not validated not validated");
			}

			if($pro_cat == "null")
			{
				$validate = false;
				echo("Category not validated");
			}

			if($pro_price<0 || empty($pro_price))
			{
				$validate = false;
				echo("Price not validated");
			}

			if($pro_quan<1 || empty($pro_price))
			{
				$validate = false;
				echo("Quantity not validated");
			}

			if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $pro_name))
			{
			    $validate = false;
			    echo("Name not validated");
			}

			if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $pro_desc))
			{
			    $validate = false;
			    echo("Name not validated");
			}

			return $validate;
		}

		function add_product($pro_name, $pro_desc, $pro_brand, $pro_cat, $pro_price, $pro_quan)
		{
			global $db;

			// Code for images upload

			// Getting images
			$product_img1 = $_FILES['product_img1']['name'];
			$product_img2 = $_FILES['product_img2']['name'];
			$product_img3 = $_FILES['product_img3']['name'];

			// echo("<script>alert('$product_img1');</script>");

			// Image temp name
			$temp_name1 = $_FILES['product_img1']['tmp_name'];
			$temp_name2 = $_FILES['product_img2']['tmp_name'];
			$temp_name3 = $_FILES['product_img3']['tmp_name'];

			// Uploading images to folder
			move_uploaded_file($temp_name1, "images/product_images/$product_img1");
			move_uploaded_file($temp_name2, "images/product_images/$product_img2");
			move_uploaded_file($temp_name3, "images/product_images/$product_img3");


			$query = "INSERT INTO `products`(`cat_id`, `brand_id`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `quantity`) VALUES (:cat_id, :brand_id, :product_title, :product_img1, :product_img2, :product_img3, :product_price, :product_desc, :quantity)";
			$stmt = $db->prepare($query);
			$stmt->bindParam(":cat_id", $pro_cat, PDO::PARAM_INT);
			$stmt->bindParam(":brand_id", $pro_brand, PDO::PARAM_INT);
			$stmt->bindParam(":product_title", $pro_name, PDO::PARAM_STR);
			$stmt->bindParam(":product_img1", $product_img1, PDO::PARAM_STR);
			$stmt->bindParam(":product_img2", $product_img2, PDO::PARAM_STR);
			$stmt->bindParam(":product_img3", $product_img3, PDO::PARAM_STR);
			$stmt->bindParam(":product_price", $pro_price, PDO::PARAM_INT);
			$stmt->bindParam(":product_desc", $pro_desc, PDO::PARAM_STR);
			$stmt->bindParam(":quantity", $pro_quan, PDO::PARAM_INT);

			if($stmt->execute())
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Congratulations</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>Product Added Successfully</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' data-toggle='modal' data-target='#add-a-product-modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");
			}

			else
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Oops</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>There was some issue adding product. Kindly contact the developer</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' data-toggle='modal' data-target='#add-a-product-modal'>Close</button>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						        $('#myModal').modal('show');
						    });
						</script>

					");
			}
		}

	}

?>