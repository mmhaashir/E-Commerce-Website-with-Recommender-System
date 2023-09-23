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
	<title>Update Cat | Admin Panel</title>
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

		if($_GET['cat_id']==null)
		{
			echo("<h1 style='text-align: center; color: red;'>Error 404</h1>");
			exit();
		}

	?>

	<?php

		$query = "SELECT * FROM `categories` WHERE `cat_id` = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$_GET['cat_id']]);

		$name="";
		$desc="";

		if($stmt->execute())
		{
			while($row = $stmt->fetch())
			{
				$name = $row['cat_title'];
				$desc = $row['cat_desc'];
			}
		}

	?>

	<br>

	<h3 style="text-align: center;">Update Category</h3><br><br>

	<div class="main-div-update" style="text-align: center;">
		<div class="inner-div-update" style="display: inline-block;">
			
			<form method="post" id="cat-form" onsubmit="return validate_cat_updation();">
    			<div class="form-group">
				    <label for="brand-name">Category Name:</label>
				    <input type="text" class="form-control" id="cat-name" maxlength="100" name="cat_name" value="<?= $name ?>">
				</div>
				<div class="form-group">
				    <label for="brand-description">Category Description:</label>
				    <textarea type="text" class="form-control" id="cat-desc" maxlength="500" rows="10" cols="10" name="cat_desc"><?php echo $desc ?></textarea>
			    </div>
			    <p id="cat-err"></p>
			    <div class="form-group">
			    	<button class="btn btn-success" name="update_cat" id="update-cat">Update Category</button>
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

		if(isset($_POST['update_cat']))
		{
			if($update->check_cat($_POST['cat_name'], $_POST['cat_desc']))
			{
				$update->update_cat($_GET['cat_id'], $_POST['cat_name'], $_POST['cat_desc']);
			}
		}
	?>

</body>
</html>