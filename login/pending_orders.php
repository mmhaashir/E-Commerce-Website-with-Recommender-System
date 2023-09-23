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
	<title>Pending Orders | Admin Panel</title>
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
		<h2 class="admin-panel-heading">Pending Orders</h2>
	</div>

	<div class="row">
		<div style="text-align: center;">
			<div style="display: inline-block;">
				<a href="manage_orders.php" class="btn btn-success" style="position: absolute; right: 0;">Go Back</a><br><br>
			</div>
		</div>
	</div>

	<br><br>

	<div class="conatiner row"  id="main-div">
		<div class="container col-md-9" style="border-right: 1px solid black;">
			<form method="post">
				<table class="table">
					<tr>
						<th style="text-align: center;">Select</th>
						<th style="text-align: center;">Order ID</th>
						<th style="text-align: center;">Customer Name</th>
						<th style="text-align: center;">Customer Phone Number</th>
						<th style="text-align: center;">Total Amount</th>
						<th style="text-align: center;">See Order</th>
					</tr>

					<?php

						$status = 'pending';
						$query = "SELECT * FROM `orders` WHERE `status` = ?";
						$stmt = $db->prepare($query);
						if($stmt->execute([$status]))
						{
							while($row = $stmt->fetch())
							{
								// echo($row['order_id']);
								echo("

										<tr>
											<td><input type='checkbox' value='".$row['order_id']."' name='make_dispatch[]'></td>	
											<td>".$row['order_id']."</td>
											<td>".$row['full_name']."</td>
											<td>".$row['ph_num']."</td>
											<td>".$row['total']."</td>
											<td><a href='see_orders.php?order_id=".$row['order_id']."' type='button' class='btn btn-info' target='blank'>See Order</a></td>
										</tr>


								");
							}
						}

					?>
				</table>
		</div>

		<div class="col-md-3">
			<button class="btn btn-success" style="position: fixed;" name="make_dispatchs">Mark As Dispatch</button>
		</div>
	</form>

	<?php

		// Function for checking if selected or not
		function validate_dispatch($make_dispatch)
		{
			if(!empty($_POST['make_dispatch']))
			{
				return true;
			}

			else
			{
				return false;
			}
		}

		function make_dispatched($make_dispatch)
		{
			global $db;
			$success = false;

			foreach($make_dispatch as $value)
			{
				$status = "dispatched";
				$query = "UPDATE `orders` SET `status`=? WHERE `order_id`=?";
				$stmt = $db->prepare($query);
				if($stmt->execute([$status, $value]))
				{
					echo("<script>alert('Order ID: ".$value.", dispatched successfully')</script>");
					$success = true;
				}
			}

			if($success==true)
			{
				// echo("<script>alert('Product(s) removed successfully')</script>");
				echo("<script>window.location.reload();</script>");
			}
		}


		if(isset($_POST['make_dispatchs']))
		{
			// echo("<script>alert('Hello World');</script>");
			if(validate_dispatch($_POST['make_dispatch']))
			{
				// echo("<script>alert('Hello World11');</script>");
				make_dispatched($_POST['make_dispatch']);
			}

			else
			{
				echo("Error");
			}
		}
	?>

	</div>

	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>