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
		<h2 class="admin-panel-heading">Manage/See Orders</h2>
	</div>

	<div class="row">
		<div style="text-align: center;">
			<div style="display: inline-block;">
				<a href="index.php" class="btn btn-success" style="position: absolute; right: 0;">Go Back</a><br><br>
			</div>
		</div>
	</div>

	<br><br>

	<div class="row"  id="main-div">

		<div class="col-md-4 inner-main-div">
			<a href="pending_orders.php"><button class="btn btn-warning admin-session-button">See Pending Orders</button></a>
		</div>
		
		<div class="col-md-4 inner-main-div">
			<a href="dispatched_orders.php"><button class="btn btn-success admin-session-button">See Dispatched Orders</button></a>
		</div>

		<div class="col-md-4 inner-main-div">
			<a href="delivered_orders.php"><button class="btn btn-warning admin-session-button">See Delivered Orders</button></a>
		</div>

	</div>

	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>