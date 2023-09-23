<?php

	try
	{

		global $db;
		$db = new PDO("mysql:host=localhost;dbname=divisma;", "root", "");
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

	}

	catch(PDOException $e)
	{
		die($e->getMessage());
	}

?>