<!DOCTYPE html>
<html>
<head>
	<title>Add to Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
</head>
<body>

	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php

	include("login/includes/db.php");
	include("includes/cart.php");

	$p = $_GET['p_id'];
	$quan = $_GET['quan'];

	$checking = "SELECT * FROM `products` WHERE `product_id` = ?";
	$stmt = $db->prepare($checking);
	$stmt->execute([$p]);

	if(($stmt->rowCount()) == 0)
	{
		echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: red;'>Error</h5>
						            </div>
						            <div class='modal-body'>
						                <p>Product not found.</p>
						            </div>
						            <div class='modal-footer'>
						            	<form method='post'><button class='btn btn-danger' data-dismiss='modal'>Close</button></form>
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

			exit();
	}

	else if(($stmt->rowCount()) == 1)
	{
		$cart = new Cart();
		
		$cart->add_to_cart($p, $quan);

		// echo("<script>history.go(-1)</script>");
	}	

?>