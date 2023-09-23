<!DOCTYPE html>
<html>
<head>
	<title>Delete From Cart</title>
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

	$mac = $_GET['mac_add'];
	$p_id = $_GET['p_id'];

	$query = "DELETE FROM `cart` WHERE `p_id` = :p_id AND `mac_add` = :mac_add";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":p_id", $p_id, PDO::PARAM_INT);
	$stmt->bindParam(":mac_add", $mac, PDO::PARAM_STR);

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
				                <p>Product deleted from the cart successfully</p>
				            </div>
				            <div class='modal-footer'>
				            	<form method='post'><button name='close_modal' class='btn btn-defaul' data-dismiss='modal' onclick='window.location=document.referrer;'>Close</button></form>
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

	if(isset($_POST['close_modal']))
	{
		header("Location: cart.php");
	}

?>