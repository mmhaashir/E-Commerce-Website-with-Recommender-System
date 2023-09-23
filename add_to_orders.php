<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
<?php
	// Code for proceeding out
	include("login/includes/db.php");
	class Proceed
	{
		function proceed_validation($total, $full_name, $add_1, $add_2, $ph_num)
		{
			$validate = true;

			if(is_numeric($total)==false)
			{
				$validate=false;
			}

			else if($full_name=="" || !(preg_match('/^[a-zA-Z ]{2,30}$/', $full_name)))
			{
				$validate=false;
			}

			else if($add_1=="")
			{
				$validate=false;
			}

			else if($add_2=="")
			{
				$validate=false;
			}

			else if($ph_num=="" || !(preg_match('/^[0][\d]{3}[\d]{7}$/', $ph_num)))
			{
				$validate=false;
			}

			else
			{
				$validate= true;
			}

			return $validate;
		}

		function add_order($total, $full_name, $add_1, $add_2, $ph_num, $mac_add)
		{
			global $db;
			if($this->proceed_validation($total, $full_name, $add_1, $add_2, $ph_num)==true)
			{
				$total_1 = $total;
				$full_name_1 = strval($full_name);
				$add_1_1 = strval($add_1);
				$add_2_1 = strval($add_2);
				$ph_num_1 = strval($ph_num);
				$mac_add_1 = $mac_add;
				$status_1 = "pending";
				$order_id = 0;

				$query = "SELECT * FROM `orders` WHERE `full_name`=? AND `add_1`=? AND `add_2`=? AND `ph_num`=? AND `total`=? AND `mac_add`=? AND `status`=?";

				$stmt_3 = $db->prepare($query);
				$stmt_3->execute([$full_name_1, $add_1_1, $add_2_1, $ph_num_1, $total_1, $mac_add_1, $status_1]);
				if($stmt_3->rowCount()>0)
				{
					echo("

									<div id='myModal' class='modal fade'>
									    <div class='modal-dialog'>
									        <div class='modal-content'>
									            <div class='modal-header'>
									                <h5 class='modal-title'>Sorry</h5>
									            </div>
									            <div class='modal-body'>
									                <p>You have place the same order already</p>
									                
									            </div>
									            <div class='modal-footer'>
									            	<form method='post'><button name='close_modal' class='btn btn-danger' data-dismiss='modal' onclick='history.go(-1)'>Close</button></form>
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
							exit();
				}

				$sql = "INSERT INTO `orders`(`full_name`, `add_1`, `add_2`, `ph_num`, `total`, `mac_add`, `status`) VALUES (?,?,?,?,?,?,?)";
				$stmt= $db->prepare($sql);

				if($stmt->execute([$full_name_1, $add_1_1, $add_2_1, $ph_num_1, $total_1, $mac_add_1, $status_1]))
				{
					$query = "SELECT * FROM `orders` WHERE `full_name`=? AND `add_1`=? AND `add_2`=? AND `ph_num`=? AND `total`=? AND `mac_add`=? AND `status`=?";

					$stmt_1 = $db->prepare($query);
					if($stmt_1->execute([$full_name_1, $add_1_1, $add_2_1, $ph_num_1, $total_1, $mac_add_1, $status_1]))
					{
						while($row = $stmt_1->fetch())
						{
							$order_id = $row['order_id'];
						}

						$checking_order_id = 0;
						$query_2 = "UPDATE `cart` SET `order_id`=? WHERE `mac_add`=? AND `order_id`=?";
						$stmt_2 = $db->prepare($query_2);
						if($stmt_2->execute([$order_id, $mac_add_1, $checking_order_id]))
						{
							echo("

									<div id='myModal' class='modal fade'>
									    <div class='modal-dialog'>
									        <div class='modal-content'>
									            <div class='modal-header'>
									                <h5 class='modal-title'>Congratulation..!!</h5>
									            </div>
									            <div class='modal-body'>
									                <p>Your order is placed.</p>
									                <p>Your order id is: <h4>".$order_id."</h4></p>
									                <p>Kindly note down the order id with your self, so you can track your order</p>
									            </div>
									            <div class='modal-footer'>
									            	<a href='index.php'><form method='post'><button name='close_modal' class='btn btn-danger' data-dismiss='modal'>Close</button></form></a>
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

					}
					// $stmt_1->bindParam(":full_name", $full_name_1, PDO::PARAM_STR);
					// $stmt_1->bindParam(":add_1", $add_1_1, PDO::PARAM_STR);
					// $stmt_1->bindParam(":add_2", $add_2_1, PDO::PARAM_STR);
					// $stmt_1->bindParam(":ph_num", $ph_num_1, PDO::PARAM_STR);
					// $stmt_1->bindParam(":total", $total_1, PDO::PARAM_INT);
					// $stmt_1->bindParam(":mac_add", $mac_add_1, PDO::PARAM_INT);
					// $stmt_1->bindParam(":status", $status_1, PDO::PARAM_STR);

					// echo("Hello World");
					
					// if($stmt_1->execute())
					// {
						
					// }
					
				}
			}
		}
	}


?>