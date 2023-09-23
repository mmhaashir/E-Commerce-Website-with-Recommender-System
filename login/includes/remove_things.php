<?php

	include("db.php");

	class Remove
	{
		// Function for checking if product is selected or not
		function check_products_removal($products)
		{
			if(!empty($products))
			{
				return true;
			}

			else
			{
				return false;
			}
		}

		// Function for removing product
		function remove_pro($products)
		{
			global $db;

			foreach($products as $value)
			{
            	$query = "DELETE FROM `products` WHERE `product_id` = ?";
            	$stmt = $db->prepare($query);
				$stmt->execute([$value]);
        	}

        	echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: green;'>Task Completed Successfully</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>Product(s) removed Successfully</p>
						            </div>

						            <div class='modal-footer'>
						            	<form method='post'>
						            		<button class='btn btn-defaul' data-dismiss='modal' id='pro-modal-close'>Close</button>
						            	</form>
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

				echo("<script>

						document.getElementById('pro-modal-close').onclick = function()
						{
							window.location.reload();
						}

					</script>");
		}

		// Function for checking if category is selected or not
		function check_categories_removal($cats)
		{
			if(!empty($cats))
			{
				return true;
			}

			else
			{
				return false;
			}
		}


		// Function for removing category
		function remove_cats($cats)
		{
			global $db;

			foreach($cats as $value)
			{
            	$query = "DELETE FROM `categories` WHERE `cat_id` = ?";
            	$stmt = $db->prepare($query);
				$stmt->execute([$value]);
        	}

        	echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: green;'>Task Completed Successfully</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>Category(s) removed Successfully</p>
						            </div>

						            <div class='modal-footer'>
						            	<form method='post'>
						            		<button class='btn btn-defaul' data-dismiss='modal' id='pro-modal-close'>Close</button>
						            	</form>
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

				echo("<script>

						document.getElementById('pro-modal-close').onclick = function()
						{
							window.location.reload();
						}

					</script>");
		}

		// Function for checking if product is selected or not
		function check_brands_removal($brands)
		{
			if(!empty($brands))
			{
				return true;
			}

			else
			{
				return false;
			}
		}

		// Function for removing brands
		function remove_brands($brands)
		{
			global $db;

			foreach($brands as $value)
			{
	        	$query = "DELETE FROM `brands` WHERE `brand_id` = ?";
	        	$stmt = $db->prepare($query);
				$stmt->execute([$value]);
	    	}

	    	echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: green;'>Task Completed Successfully</h5>
						                
						            </div>
						            <div class='modal-body'>
						                <p>Brand(s) removed Successfully</p>
						            </div>

						            <div class='modal-footer'>
						            	<form method='post'>
						            		<button class='btn btn-defaul' data-dismiss='modal' id='pro-modal-close'>Close</button>
						            	</form>
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

				echo("<script>

						document.getElementById('pro-modal-close').onclick = function()
						{
							window.location.reload();
						}

					</script>");
		}


	}


?>