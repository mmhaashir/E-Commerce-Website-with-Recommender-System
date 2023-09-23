<?php

	include("includes/session.php");
	include("includes/db.php");

	if(!isset($_SESSION["admin"]))
	{
		header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Brands | Admin Panel</title>
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

	<?php

		if($_GET['brand_id']==null)
		{
			echo("<h1 style='text-align: center; color: red;'>Error 404</h1>");
			exit();
		}

	?>

	<?php

		$query = "SELECT * FROM `brands` WHERE `brand_id` = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$_GET['brand_id']]);

		$name="";
		$desc="";

		if($stmt->execute())
		{
			while($row = $stmt->fetch())
			{
				$name = $row['brand_title'];
				$desc = $row['brand_desc'];
			}
		}

	?>

	<br>

	<h3 style="text-align: center;">Update Brand</h3><br><br>

	<div class="main-div-update" style="text-align: center;">
		<div class="inner-div-update" style="display: inline-block;">
			
			<form method="post" id="brand-form" onsubmit="return validate_brand_updation();">
    			<div class="form-group">
				    <label for="brand-name">Brand Name:</label>
				    <input type="text" class="form-control" id="brand-name" maxlength="100" name="brand_name" value="<?= $name ?>">
				</div>
				<div class="form-group">
				    <label for="brand-description">Brand Description:</label>
				    <textarea type="text" class="form-control" id="brand-desc" maxlength="500" rows="10" cols="10" name="brand_desc"><?php echo $desc ?></textarea>
			    </div>
			    <p id="brand-err"></p>
			    <div class="form-group">
			    	<button class="btn btn-success" name="update_brand" id="update-brand">Update Category</button>
			    </div>
    		</form>

		</div>
	</div>


	<!-- JS -->
	<script src="js/main_js.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<?php

		include('includes/update_things.php');

		$update = new Update();

		if(isset($_POST['update_brand']))
		{
			if($update->check_brand($_POST['brand_name'], $_POST['brand_desc']))
			{
				$update->update_brand($_GET['brand_id'], $_POST['brand_name'], $_POST['brand_desc']);
			}
		}
	?> 

</body>
</html>