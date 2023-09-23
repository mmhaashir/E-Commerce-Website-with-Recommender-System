<?php

	include("login/includes/db.php");

	class Cart
	{

		// Get Mac Address
		// function getMac()
		// {
		// 	$mac='UNKNOWN';
		// 	foreach(explode("\n",str_replace(' ','',trim(`getmac`,"\n"))) as $i)
		// 	if(strpos($i,'Tcpip')>-1){$mac=substr($i,0,17);break;}
		// 	return $mac;
		// }

		function getMac()
		{
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		        //ip from share internet
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		        //ip pass from proxy
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }else{
		        $ip = $_SERVER['REMOTE_ADDR'];
		    }
		    return $ip;
		}


		// Get ip address of user
		function getUserIpAddr()
		{
		    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		        //ip from share internet
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		        //ip pass from proxy
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }else{
		        $ip = $_SERVER['REMOTE_ADDR'];
		    }
		    return $ip;
		}

		function add_to_cart($p_id, $quan)
		{
			global $db;
			// $ip = $this->getUserIpAddr();
			$mac = $this->getMac();

			$checking_product = "SELECT * FROM `cart` WHERE `p_id` = :p_id AND `mac_add` = :mac_add";
			$stmt = $db->prepare($checking_product);
			$stmt->bindParam(":p_id", $p_id, PDO::PARAM_INT);
			$stmt->bindParam(":mac_add", $mac, PDO::PARAM_INT);

			if(($stmt->rowCount()) > 0)
			{
				echo("

						<div id='myModal' class='modal fade'>
						    <div class='modal-dialog'>
						        <div class='modal-content'>
						            <div class='modal-header'>
						                <h5 class='modal-title' style='color: red;'>Error</h5>
						            </div>
						            <div class='modal-body'>
						                <p>Product already present in your cart.</p>
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

			else
			{
				$status = 0;
				$insert_to_cart = "INSERT INTO `cart`(`p_id`, `mac_add`, `qty`, `status`) VALUES (:p_id, :mac_add, :qty, :status)";
				$stmt = $db->prepare($insert_to_cart);
				$stmt->bindParam(":p_id", $p_id, PDO::PARAM_STR);
				$stmt->bindParam(":mac_add", $mac, PDO::PARAM_STR);
				$stmt->bindParam(":qty", $quan, PDO::PARAM_STR);
				$stmt->bindParam(":status", $status, PDO::PARAM_INT);

				if($stmt->execute())
				{
					echo("

							<div id='myModal' class='modal fade'>
							    <div class='modal-dialog'>
							        <div class='modal-content'>
							            <div class='modal-header'>
							                <h5 class='modal-title'>Congratulations</h5>
							     
							            </div>
							            <div class='modal-body'>
							                <p>Product added to cart Successfully</p>
							            </div>
							            <div class='modal-footer'>
							            	<form method='post'><button name='close_modal' class='btn btn-defaul' data-dismiss='modal' onclick='history.go(-1)'>Close</button></form>
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

							<div id='myModal' class='modal fade'>
							    <div class='modal-dialog'>
							        <div class='modal-content'>
							            <div class='modal-header'>
							                <h5 class='modal-title'>Oops</h5>
							                
							            </div>
							            <div class='modal-body'>
							                <p>There was some issue adding the product to cart.</p>
							            </div>
							            <div class='modal-footer'>
							            	<form method='post'><button name='close_modal' class='btn btn-defaul' data-dismiss='modal' onclick='window.location=document.referrer;'>Close</button></form>
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

				if(isset($_POST['close_modal']))
				{
					echo("<script>history.go(-1)</script>");
				}
			}
		}
	}


?>