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
		<h2 class="admin-panel-heading">Add Top Selling Products</h2>
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

						$query = "SELECT * FROM `products`";
						$stmt = $db->prepare($query);

						if($stmt->execute())
						{
							while($row = $stmt->fetch())
							{
								echo("

										<tr style='text-align: center;'>

											<td><input type='checkbox' value='".$row['product_id']."' class='' name='products[]'></input></td>
											<td>".$row['product_title']."</td>
											<td><img style='width: 50px; height: 50px;' src='images/product_images/".$row['product_img1']."'></td>
											<td><p>".$row['product_desc']."</p></td>

										</tr>


									");
							}
						}

					?>
				</table>
		</div>

		<!-- action button -->
		<div class="col-md-3">
			<button class="btn btn-success" style="position: fixed;" name="add_top_selling">Add to Top Selling</button>
		</div>
	</form>
	</div>

	<?php

		// Function for checking if selected or not
		function validate_addition($top_selling)
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

		function add_top_sellings($top_selling)
		{
			$already_present = array();
			global $db;

			foreach($top_selling as $value)
			{
            	$query = "SELECT *  FROM `top_selling` WHERE `p_id` = ?";
            	$stmt = $db->prepare($query);
				$stmt->execute([$value]);

				if($stmt->rowCount()>0)
				{
					while($row = $stmt->fetch())
					{
						array_push($already_present, $row['product_title']);
					}
				}

				else
	        	{
	        		$query_2 = "INSERT INTO `top_selling`(`p_id`) VALUES(?)";
	        		$stmt_2= $db->prepare($query_2);
					if($stmt_2->execute([$value]))
					{
						
						echo("<script>alert('Product(s) added successfully')</script>");
					}
	        	}
        	}

        	if(empty($already_present)==false)
        	{
        		echo("

								<div id='myModal' class='modal fade'>
								    <div class='modal-dialog'>
								        <div class='modal-content'>
								            <div class='modal-header'>
								                <h5 class='modal-title' style='color: green;'>Task Completed Successfully</h5>
								                
								            </div>
								            <div class='modal-body'>
								                <p>Product(s) Added Successfully</p>
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
        	}

        	
		}

		if(isset($_POST['add_top_selling']))
		{
			if(validate_addition($_POST['products']))
			{
				add_top_sellings($_POST['products']);
			}
		}

	?>

	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>