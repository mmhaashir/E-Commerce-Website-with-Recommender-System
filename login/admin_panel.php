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
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
	<link rel="stylesheet" type="text/css" href="css/my.css">
</head>
<body>

	<br>

	<!-- Admin Panel -->
	<div class="container">
		<h2 class="admin-panel-heading">Welcome to Admin Panel "<?php echo ($_SESSION['admin']) ?>" <form method="post" style="display: inline;"><button class="btn btn-danger logout" name="logout">Logout</button></form></h2>

		<br><br>

		<div class="row" id="main-div">

			<!-- Row 1 -->
			<div class="col-md-4 inner-main-div">
				<a href="admin_add.php">
					<button class="btn btn-success admin-session-button">Add (Products, Cats etc)</button>
				</a>
			</div>

			<!-- Row 2 -->
			<div class="col-md-4 inner-main-div">
				<a href="admin_update.php">
					<button class="btn btn-warning admin-session-button">Update (Products, Cats etc)</button>
				</a>
			</div>

			<!-- Row 3 -->
			<div class="col-md-4 inner-main-div">
				<a href="admin_remove.php">
					<button class="btn btn-danger admin-session-button">Remove (Products, Cats etc)</button>
				</a>
			</div>

		</div>
		<br>
		<div class="row" id="main-div">
			<div class="col-md-4 inner-main-div">
				<a href="top_selling_products.php">
					<button class="btn btn-success admin-session-button">Top Selling Products</button>
				</a>
			</div>

			<div class="col-md-4 inner-main-div">
				<a href="manage_orders.php">
					<button class="btn btn-warning admin-session-button">See/Manage Orders</button>
				</a>
			</div>
		</div>
	</div>
	

	<!-- JS -->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<?php

		if(isset($_POST["logout"]))
		{
			unset($_SESSION["admin"]);
			header("Location: index.php");
		}

	?>
</body>
</html>
