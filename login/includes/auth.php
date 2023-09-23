<!DOCTYPE html>
<html>
<head>
	<title>Authenticate</title>

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

</head>
<body>

	<script type="text/javascript">
		if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

<?php

	include("db.php");
	include("session.php");

	// Class for registeration and authorization
	class register
	{
		// Function for registration of new admin
		function reg($f_name, $l_name, $username, $password, $soft_delete)
		{
			global $db;
			$password_hash = password_hash($password, PASSWORD_DEFAULT);

			$query = "INSERT INTO `admin`(`f_name`, `l_name`, `username`, `password`, `soft_delete`) VALUES (:fname, :lname, :username, :password, :soft_delete)";

			$stmt = $db->prepare($query);
			$stmt->bindParam(":fname", $f_name, PDO::PARAM_STR);
			$stmt->bindParam(":lname", $l_name, PDO::PARAM_STR);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password_hash, PDO::PARAM_STR);
			$stmt->bindParam(":soft_delete", $soft_delete, PDO::PARAM_INT);

			if($stmt->execute())
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Congratulations</h5>
						                <button type='button' class='close' data-dismiss='modal'>&times;</button>
						            </div>
						            <div class='modal-body'>
						                <p>You've been registered successfully</p>
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

			else
			{
				echo("

						<div id='myModal-1' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title'>Oops</h5>
						                <button type='button' class='close' data-dismiss='modal'>&times;</button>
						            </div>
						            <div class='modal-body'>
						                <p>There was some issue registering. Please contact the developer</p>
						            </div>
						        </div>
						    </div>
						</div>

					");

				echo("

						<script>
						    $(document).ready(function(){
						    	$('#').modal('show');
						        $('#myModal-1').modal('show');
						    });
						</script>

					");
			}
		}

		// Function for logging in an admin
		function login($username, $password)
		{
			global $db;

			$query = "SELECT * FROM `admin` WHERE `username`=?";
			$stmt = $db->prepare($query);
			$stmt->execute([$username]);
			
			if(($stmt->rowCount()) > 0)
			{
				while($row = $stmt->fetch())
				{
					
					if(password_verify($password, $row['password']))
					{
						$full_name = $row["f_name"]." ".$row["l_name"];
						$_SESSION['admin'] = $full_name;
						header("Location: admin_panel.php");
					}

					else
					{
						echo("<script>

								document.getElementById('incorrect-creds').innerHTML = 'Incorrect Credentials';

							</script>");
					}
				}
			}
		
			else
			{
				echo("<script>

						document.getElementById('incorrect-creds').innerHTML = 'Incorrect Credentials';

					</script>");
			}

		}
	} 

?>