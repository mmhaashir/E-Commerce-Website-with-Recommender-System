<?php

	include("includes/session.php");
	include("includes/db.php");

	error_reporting(E_ERROR | E_PARSE);

	if(!isset($_SESSION['admin']))
	{
		header("Location: index.php");
	}

	if($_GET['order_id']==null)
	{
		echo("Wrong Page");
		exit();
	}

	$order_id = $_GET['order_id']

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dispatched Orders | Admin Panel</title>
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
		<h2 class="admin-panel-heading" style="text-decoration: underline;">See Order</h2>
	</div>

	<div class="row">
		<div style="text-align: center;">
			<div style="display: inline-block;">
				<a href="manage_orders.php" class="btn btn-success" style="position: absolute; right: 0;">Go Back</a><br><br>
			</div>
		</div>
	</div>

	<br><hr>
	<?php

		$order_id = $_GET['order_id'];
		$query = "SELECT * FROM `orders` WHERE `order_id` = ?";
		$stmt = $db->prepare($query);
		$order_status = "";
		if($stmt->execute([$order_id]))
		{
			// echo("<h2 style='text-align: center;'>".$order_id."</h2>");
			while($row = $stmt->fetch())
			{
				$status = $row['status'];
				echo("<h4 style='text-align: center;'>Order ID: <b>".$row['order_id']."</b></h4><br>");
				echo("<h4 style='text-align: center;'>Status: <b>".$row['status']."</b></h4><br>");
				echo("<h4 style='text-align: center;'>Customer Name: <b>".$row['full_name']."</b></h4><br>");
				echo("<h4 style='text-align: center;'>Customer Phone Number: <b>".$row['ph_num']."</b></h4><br>");
				echo("<h4 style='text-align: center;'>Address Line 1: <b>".$row['add_1']."</b></h4><br>");
				echo("<h4 style='text-align: center;'>Email: <b>".$row['add_2']." </b></h4><br>");
				echo("<div style='text-align: center;'><div style='display: inline-block;'><div style='border: 1px solid black; width: 150%; text-align: center;'><h4><b>Items:</b></h4>");
				echo("<table style='text-align:center;'>

													<tr style='text-align:center;'>
														<th style='text-align:center; border-right: 1px solid black;'>Name</th>
														<th style='text-align:center;'>Price</th>
													</tr>");

				$query_2 = "SELECT * FROM `cart` WHERE `order_id` = ?";
				$stmt_2 = $db->prepare($query_2);
				if($stmt_2->execute([$order_id]))
				{
					while($row_2 = $stmt_2->fetch())
					{
						// echo("<script>alert('Hello WOrld')</script>");
						$p_id = $row_2['p_id'];

						$query_3 = "SELECT * FROM `products` WHERE `product_id`=?";
						$stmt_3 = $db->prepare($query_3);
						if($stmt_3->execute([$p_id]))
						{
							while($row_3 = $stmt_3->fetch())
							{
								echo("
											
												

													<tr style='text-align:center;'>

														<td style='text-align:center; border-right: 1px solid black;'>".$row_3['product_title']."</td>
														<td style='text-align:center;'>".$row_3['product_price']."</td>
													</tr>

												

									");
							}
						}
					}
					
				}
				echo("</table>");
				echo("</div></div></div>");
				echo("<br>");
				echo("<h4 style='text-align: center;'>Total: <b>Rs ".$row['total']." </b></h4><br>");

				if($status == 'pending')
				{
					echo("

							<div style='text-align: center;'>

								<div style='display: inline-block;'>

									<form method='post'><button class='btn btn-success' name='mark_as_dispatched'>Mark As Dispatched</button></form>

								</div>

							</div>

						");
				}

				else if($status == 'dispatched')
				{
					echo("

							<div style='text-align: center;'>

								<div style='display: inline-block;'>

									<form method='post'><button class='btn btn-success' name='mark_as_delivered'>Mark As Delivered</button></form>

								</div>

							</div>

						");
				}

			}
		}

		if(isset($_POST['mark_as_dispatched']))
		{
			$status_pending = "dispatched";
			$query_pending = "UPDATE `orders` SET `status` = ? WHERE `order_id` = ?";
			$stmt_pending = $db->prepare($query_pending);
			if($stmt_pending->execute([$status_pending, $_GET['order_id']]))
			{
				echo("<script>alert('Order Status Set To Dispatched Successfully');</script>");

			} 

			else
			{
				echo("<script>alert('Not Working');</script>");
			}
		}

		if(isset($_POST['mark_as_delivered']))
		{
			$status_delivered = "delivered";
			$query_delivered = "UPDATE `orders` SET `status` = ? WHERE `order_id` = ?";
			$stmt_delivered = $db->prepare($query_delivered);
			if($stmt_delivered->execute([$status_delivered, $_GET['order_id']]))
			{
				echo("<script>alert('Order Status Set To Delivered Successfully');</script>");

			} 

			else
			{
				echo("<script>alert('Not Working');</script>");
			}
		}

	?>

	<br><br>

	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>