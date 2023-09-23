<?php

	include("login/includes/db.php");
	include("includes/cart.php");
	include("includes/getip.php");

	error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

	if($_GET['p_id']==null)
	{
		echo("Wrong Page");
		exit();
	}

	$ip = get_client_ip();
	echo($ip);
	$p_id = $_GET['p_id'];
	$brand_id = 0;

	// Get brand of the product for recommender
	$getBrand = "SELECT `brand_id` FROM `products` WHERE `product_id`=?";
	$statement = $db->prepare($getBrand);
	$statement->execute([$p_id]);

	while($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		$brand_id = $row['brand_id'];
	}
	
	// Inserting brand_id against the ip_address for recommender
	$insertBrand = "INSERT INTO `recommender`(`ip`, `brand_id`) VALUES (:ip, :brand_id)";
	$statement1 = $db->prepare($insertBrand);
	$statement1->bindParam(":ip", $ip, PDO::PARAM_STR);
	$statement1->bindParam(":brand_id", $brand_id, PDO::PARAM_INT);
	$statement1->execute();

?>


<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Kamran Spare | Home Page</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="kamran spare, k&k spare, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/logo.png" rel="shortcut icon"/>

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
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="index.html" class="site-logo">
							<!-- logo -->
						<a href="./index.html" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form" method="GET" onsubmit="return validate_search();">
							<input type="text" placeholder="Search on Kamran Spare ...." name="search_query" id="search-query">
							<button type="" name="submit" type="submit"><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<?php

										$cart = new Cart();
										$mac = $cart->getMac();
										$cart_item_counter = 0;

										$stmt = $db->prepare("SELECT * FROM `cart` WHERE `mac_add`=? AND `order_id` = ?");
										$order_id = 0;
										$stmt->execute([$mac, $order_id]); 
										
										while($row = $stmt->fetch(PDO::FETCH_ASSOC))
										{
											$cart_item_counter+=1;
										}
									?>
									<span><?php echo($cart_item_counter); ?></span>
								</div>
								<a href="cart.php">Shopping Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="repairing_machines.php">Repairing Machines 
					<span class="new">New</span></li></a></li>
					<li><a href="categories.php">Categories</a></li>
					<li><a href="brands.php">Brands</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->

	<?php

		if(isset($_GET['submit']))
		{
			if($_GET['search_query']!=null)
			{
				header("Location: search.php?search_query=".$_GET['search_query']);
			}
		}

	?>
	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="row">
				<?php

					$query = "SELECT * FROM `products` WHERE `product_id` = ?";
					$stmt = $db->prepare($query);
					$stmt->execute([$p_id]);

					while($row = $stmt->fetch())
					{
						echo("

							<div class='col-lg-6'>
								<div class='product-pic-zoom'>
									<img class='product-big-img' src='login/images/product_images/".$row['product_img1']."' alt=''>
								</div>
								<div class='product-thumbs' tabindex='1' style='overflow: hidden; outline: none;'>
									<div class='product-thumbs-track'>
										<div class='pt active' data-imgbigurl='../login/images/product_images/".$row['product_img1']."'><img src='login/images/product_images/".$row['product_img1']."' alt=''></div>
										<div class='pt' data-imgbigurl='login/images/product_images/".$row['product_img2']."'><img src='login/images/product_images/".$row['product_img2']."' alt=''></div>
										<div class='pt' data-imgbigurl='login/images/product_images/".$row['product_img1']."'><img src='login/images/product_images/".$row['product_img3']."' alt=''></div>
										
									</div>
								</div>
							</div>

							");
			
						echo("


							<div class='col-lg-6 product-details'>
								<h2 class='p-title'>".$row['product_title']."</h2>
								<h3 class='p-price'>".$row['product_price']." Rs</h3>
								<h4 class='p-stock'>Available: <span>".$row['quantity']."</span></h4><br>
								
								<div class='p-rating'>
									
								</div>
								<div class='p-review'>
									
								</div>
								<div class='fw-size-choose'>
									
								</div>");
								?>
								
			                    <form method='get'>
			                    	<div class='quantity'>
				                        <div class='pro-qty'>
											<input type='text' value='1' id='quan' name='qty'>
										</div>
	            					</div>
	            					<input type="hidden" name="p_id" value="<?php echo($p_id); ?>">
									<button type='input' name='add_to_cart' href='#' class='site-btn'>Add to Cart</button>
								</form>
							<?php
							echo("

								<div id='accordion' class='accordion-area'>
									<div class='panel'>
										<div class='panel-header' id='headingOne'>
											<button class='panel-link active' data-toggle='collapse' data-target='#collapse1' aria-expanded='true' aria-controls='collapse1'>information</button>
										</div>
										<div id='collapse1' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'>
											<div class='panel-body'>
												<pre>".$row['product_desc']."</pre>
											</div>
										</div>
									</div>
									<div class='panel'>
										<div class='panel-header' id='headingTwo'>
											<button class='panel-link' data-toggle='collapse' data-target='#collapse2' aria-expanded='false' aria-controls='collapse2'>Payment details </button>
										</div>
										<div id='collapse2' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'>
											<div class='panel-body'>
												<p>Payment on Delivery</p>
											</div>
										</div>
									</div>
									<div class='panel'>
										<div class='panel-header' id='headingThree'>
											<button class='panel-link' data-toggle='collapse' data-target='#collapse3' aria-expanded='false' aria-controls='collapse3'>shipping & Returns</button>
										</div>
										<div id='collapse3' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'>
											<div class='panel-body'>
												<h4>7 Days Returns</h4>
												<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
												
											</div>
										</div>
									</div>
								</div>
								<div class='social-sharing'>
									
								</div>
							</div>



							");

					}

					if(isset($_GET['add_to_cart']))
					{
						global $db;
						$cart = new Cart();
						$mac = $cart->getMac();
						$qty = $_GET['qty'];
						$p_id = $_GET['p_id'];

						
							$query = "INSERT INTO `cart`(`p_id`, `mac_add`, `qty`) VALUES (:p_id, :mac_add, :qty)";
							$stmt = $db->prepare($query);
							$stmt->bindParam(":p_id", $p_id, PDO::PARAM_STR);
							$stmt->bindParam(":mac_add", $mac, PDO::PARAM_STR);
							$stmt->bindParam(":qty", $qty, PDO::PARAM_STR);
						
						if($stmt->execute())
						{
							echo("<script>alert('Product added to cart Successfully')</script>");
						}

						else
						{
							echo("<script>alert('There was an issue adding the product to the cart')</script>");
						}
					}


				?>
			</div>
		</div>
	</section>

	<?php if(isset($_POST['add_to_cart'])){echo('Hello World');} ?>

	<!-- product section end -->

	<!-- Footer section -->
	<section class="footer-section">
		<div class="container">
			<div class="footer-logo text-center">
				<!-- <a href="index.html"><img src="./img/logo-light.png" alt=""></a>
 -->			
 				<a href="index.html"><img src="./img/logo-light.png" alt=""></a>
</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>About</h2>
						<p>We Deal in all kinds of mobile spare parts</p>
						<img src="img/cards.png" alt="">
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Questions</h2>
						<ul>
							<li><a href="">About Us</a></li>
							<li><a href="">Categories</a></li>
							<li><a href="">Brands</a></li>
							<li><a href="">Contact Us</a></li>
							<li><a href="">Home</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Questions</h2>
						<div class="fw-latest-post-widget">
							<div class="lp-item">
								
								<div class="lp-content">
									<h6>what to buy</h6>
									<!--<span>Oct 21, 2020</span>-->
									<a href="#" class="readmore">Read More</a>
								</div>
							</div>
							<div class="lp-item">
								
								<div class="lp-content">
									<h6>trends this year</h6>
									<!--<span>Oct 21, 2020</span>-->
									<a href="#" class="readmore">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget contact-widget">
						<h2>Questions</h2>
						<div class="con-info">
							<span>C.</span>
							<p>E-Commerce Recommender</p>
						</div>
						<div class="con-info">
							<span>B.</span>
							<p>Peshawar</p>
						</div>
						<div class="con-info">
							<span>T.</span>
							<p>+92 300 000 0000</p>
						</div>
						<div class="con-info">
							<span>E.</span>
							<p>abc@gmail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="social-links-warp">
			<div class="container" style='text-align: center;'>
				<div class="social-links" style='display: inline-block;'>
					<a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
					<a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
					<a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
				</div>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> 
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | K&K Accessories</p>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

			</div>
		</div>
	</section>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript" src="js/form_validation.js"></script>

	</body>
</html>
