<?php

	include("login/includes/db.php");
	include("includes/cart.php");
	include('add_to_orders.php');

	if($_GET['mac_add']==null)
	{
		echo("Wrong Entery");
		exit();
	}

	$mac = $_GET['mac_add'];
	$total = $_GET['total'];

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


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" name="checkout_form" method="get" onsubmit='return validate();'>
						<div class="cf-title">Billing Address</div>

						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="hidden" name="mac_add" value="<?php echo($mac); ?>">
								<input type="hidden" name="total" value="<?php echo($total); ?>">
								<input type="text" placeholder="Full Name" name="full_name" id="full-name">
								<p style="color: red; display: hidden;" id="name-err"></p>
								<input type="text" placeholder="Address" id="add1" name="add_1">
								<p style="color: red; display: hidden;" id="add1-err"></p>
								<input type="text" placeholder="Email (abc@xyz.com)" id="add2" name="add_2">
								<p style="color: red; display: hidden;" id="add2-err"></p>
							</div>
							<!-- <div class="col-md-6">
								<input type="text" placeholder="Zip code" id="zip">
								<p style="color: red; display: hidden;" id="zip-err"></p>
							</div> -->
							<div class="col-md-12">
								<input type="text" placeholder="Phone no. (+923XXXXXXXXX)" id="ph-num" name="ph_num">
								<p style="color: red; display: hidden;" id="ph-err"></p>
							</div>
						</div>
						<div class="cf-title">Delievery Info</div>
						<div class="row shipping-btns">
							<div class="col-6">
								<h4>Standard</h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">
										<p style="font-size: 1.2em;"><b>Free</b></p>
									</div>
								</div>
							</div>
						</div>
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
							<h5>Cash on Delivery</h5><br>
							<li>Pay when you get the package</li>
						</ul>
						<button class="site-btn submit-order-btn" type="submit" name="proceed">Place Order</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class='product-list'>
						<?php

							$cart = new Cart();
							$mac = $_GET['mac_add'];
							$order_id = 0;
							$query = "SELECT * FROM `cart` WHERE `mac_add`=:mac_add AND `order_id`=:order_id";
							$stmt = $db->prepare($query);
							$stmt->bindParam(":order_id", $order_id, PDO::PARAM_INT);
							$stmt->bindParam(":mac_add", $mac, PDO::PARAM_INT);

							$products_present = array();

							if($stmt->execute())
							{
								while($row = $stmt->fetch())
								{
									array_push($products_present, $row['p_id']);
								}

								for($i=0; $i<count($products_present); $i++)
								{
									$showing_results = "SELECT * FROM `products` WHERE `product_id` = ?";
									$stmt_1 = $db->prepare($showing_results);
									$stmt_1->execute([$products_present[$i]]);	
									
									while($row = $stmt_1->fetch())
									{
										echo("

												<li>
													<div class='pl-thumb'><img src='login/images/product_images/".$row['product_img1']."' alt=''></div>
													<h6>".$row['product_title']."</h6>
													<p>".$row['product_price']."</p>
												</li>

											");
									}
								}
							}

						?>
					</ul>
						<ul class="price-list">
							<li>Total<span>Rs <?php echo($_GET['total']); ?></span></li>
							<li>Shipping<span>free</span></li>
							<li class="total">Total<span>Rs <?php echo($_GET['total']); ?></span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php

		if(isset($_GET['proceed']))
		{
			$mac = $_GET['mac_add'];
			$total = $_GET['total'];
			$full_name = $_GET['full_name'];
			$add_1 = $_GET['add_1'];
			$add_2 = $_GET['add_2'];
			$ph_num = $_GET['ph_num'];

			$proceed = new Proceed();
			$proceed->add_order($total, $full_name, $add_1, $add_2, $ph_num, $mac);
		}

	?>
	<!-- checkout section end -->

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
