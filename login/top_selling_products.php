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
		<h2 class="admin-panel-heading">Add/Remove Top Selling Products</h2>
	</div>

	<br><br>

	<div class="row"  id="main-div">
		
		<div class="col-md-4 inner-main-div">
			<a href="add_top_products.php"><button class="btn btn-success admin-session-button">Add Top Selling Products</button></a>
		</div>

		<div class="col-md-4 inner-main-div">
			<a href="remove_top_products.php"><button class="btn btn-warning admin-session-button">Remove Top Selling Products</button></a>
		</div>

	</div>

	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>