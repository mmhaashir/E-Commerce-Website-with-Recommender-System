<?php

	include("includes/session.php");
	include("includes/db.php");

	error_reporting(E_ERROR | E_PARSE);

	if(!isset($_SESSION['admin']))
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
	<div class="container">
		<h2 class="admin-panel-heading">Remove Top Selling Products</h2>
		<a href='top_selling_products.php'><button class="btn btn-success" style="float: left; margin-bottom: 10px;">Go back</button></a>
	</div>
	<br><br>
	<div class="row">
		<!-- products -->
		<div class="col-md-9" style="border-right: 1px solid black;">
			<form method="post">
				<table class="table" style="text-align: center;">
					<tr>
						<th style="text-align: center;">Select</th>
						<th style="text-align: center;">Product Title</th>
						<th style="text-align: center;">Product Image</th>
						<th style="text-align: center;">Product Description</th>
					</tr>

					<?php

						$query = "SELECT * FROM `top_selling`";
						$stmt = $db->prepare($query);

						if($stmt->execute())
						{
							while($row = $stmt->fetch()){
							
								$id = $row['p_id'];
								// echo($id);
								$query_1 = "SELECT * FROM `products` WHERE `product_id` = ?";
								$stmt_1 = $db->prepare($query_1);

								if($stmt_1->execute([$id]))
								{
									while($row_1 = $stmt_1->fetch())
									{
										echo("

										<tr style='text-align: center;'>

											<td><input type='checkbox' value='".$row_1['product_id']."' class='' name='products[]'></input></td>
											<td>".$row_1['product_title']."</td>
											<td><img style='width: 50px; height: 50px;' src='images/product_images/".$row_1['product_img1']."'></td>
											<td><p>".$row_1['product_desc']."</p></td>

										</tr>


									");
									}
								}
							}
							}
						

					?>
				</table>
		</div>

		<!-- action button -->
		<div class="col-md-3">
			<button class="btn btn-success" style="position: fixed;" name="remove_top_selling">Remove From Top Selling</button>
		</div>
	</form>
	</div>

	<?php

		// Function for checking if selected or not
		function validate_removal($top_selling)
		{
			if(!empty($top_selling))
			{
				return true;
			}

			else
			{
				return false;
			}
		}

		function remove_top_selling($top_selling)
		{
			global $db;
			$success = false;

			foreach($top_selling as $value)
			{
				$query = "DELETE FROM `top_selling` WHERE `p_id` = ?";
				$stmt = $db->prepare($query);
				if($stmt->execute([$value]))
				{
					$success = true;
				}
			}

			if($success==true)
			{
				echo("<script>alert('Product(s) removed successfully')</script>");
				echo("<script>window.location.reload();</script>");
			}
		}

		if(isset($_POST['remove_top_selling']))
		{
			if(validate_removal($_POST['products']))
			{
				remove_top_selling($_POST['products']);
			}
		}

	?>
	
	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>