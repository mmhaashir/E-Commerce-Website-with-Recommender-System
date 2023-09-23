<?php

	include("db.php");

	class Update
	{
		// Function for backend category check
		function check_cat($title, $desc)
		{

			global $db;

			// Variable for checking validity
			$validate = true;

			// If any of field is empty, validation is cancelled
			if(strlen($title)<1 || strlen($desc)<1)
			{
				$vaildate = false;
			}

			else if(strlen($title)>100 || strlen($desc)>500)
			{
				$validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $title))
			{
			    $validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $desc))
			{
			    $validate = false;
			}

			else
			{
				$validate = true;
			}

			return $validate;
		}

		// Function for sending caregory to database
		function update_cat($cat_id, $title, $desc)
		{
			global $db;

			$query = "UPDATE `categories` SET `cat_title`=:cat_title, `cat_desc`=:cat_desc WHERE `cat_id`=:cat_id";
			$stmt = $db->prepare($query);
			$stmt->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
			$stmt->bindParam(":cat_title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":cat_desc", $desc, PDO::PARAM_STR);

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
						                <p>Category Updated Successfully</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' id='close-button'>Close</button>
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

				echo("

					<script>

						document.getElementById('close-button').onclick = function()
						{
							window.close();
						}

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
						                <p>There was some issue updating category. Kindly contact the developer</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
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

		// Function for backend validation of brands
		function check_brand($title, $desc)
		{
			global $db;

			// Variable for checking validity
			$validate = true;

			// If any of field is empty, validation is cancelled
			if(strlen($title)<1 || strlen($desc)<1)
			{
				$vaildate = false;
			}

			else if(strlen($title)>100 || strlen($desc)>500)
			{
				$validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $title))
			{
			    $validate = false;
			}

			else if (preg_match('/[\'^£$%&*()}{@#~?><>|=_+¬-]/', $desc))
			{
			    $validate = false;
			}

			else
			{
				$validate = true;
			}

			return $validate;
		}

		// Function for sending brand to database
		function update_brand($brand_id, $title, $desc)
		{
			global $db;

			$query = "UPDATE `brands` SET `brand_title`=:brand_title, `brand_desc`=:brand_desc WHERE `brand_id`=:brand_id";
			$stmt = $db->prepare($query);
			$stmt->bindParam(":brand_id", $brand_id, PDO::PARAM_INT);
			$stmt->bindParam(":brand_title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":brand_desc", $desc, PDO::PARAM_STR);

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
						                <p>Brand Updated Successfully</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal' id='close-button'>Close</button>
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

				echo("

					<script>

						document.getElementById('close-button').onclick = function()
						{
							window.close();
						}

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
						                <p>There was some issue updating brand. Kindly contact the developer</p>
						            </div>
						            <div class='modal-footer'>
						            	<button class='btn btn-defaul' data-dismiss='modal'>Close</button>
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

		function check_pro($title, $desc, $brand, $cat, $price, $quan)
		{
			
		}
	}


?>