<?php

	include("login/includes/db.php");
	include("includes/cart.php");

	$status = 0;
	$query = "SELECT * FROM `cart` WHERE `mac_add`=:mac_add AND `status`=:status";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":mac_add", $mac_add, PDO::PARAM_INT);
	$stmt->bindParam(":status", $status, PDO::PARAM_INT);

	if($stmt->execute())
	{
		while($row = $stmt->fetch())
		{
			$p_id = $row['p_id'];
			$quan = $_GET['quan'];

			echo($p_id." ".$quan);
		}
	}

?>