<?php
	
	include("auth.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Admin</title>
</head>
<body>

	<form method="post">
		
		<input type="text" name="f-name" placeholder="First Name" required="">
		<input type="text" name="l-name" placeholder="Last Name" required="">
		<input type="text" name="username" placeholder="Username" required="">
		<input type="password" name="password" placeholder="******" required="">
		<button name="register">Register</button>

	</form>

	<?php

		if(isset($_POST["register"]))
		{
			$f_name   = $_POST["f-name"];
			$l_name   = $_POST["l-name"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$soft_delete = 0;

			$auth = new register();

			$auth->reg($f_name, $l_name, $username, $password, $soft_delete);

		}

	?>

</body>
</html>