<?php

	include("login/includes/db.php");
	include("includes/cart.php");

	// array for recommendations
	$recom_array = [];

	// Getting recommendations

	$recommendations = "SELECT brand_id, Count(brand_id) as TotalReps FROM recommender Group By brand_id Order By TotalReps DESC LIMIT 2;";
	$statement = $db->prepare($recommendations);
	if($statement->execute()){
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			// echo($row['brand_id']);
			array_push($recom_array, $row['brand_id']);
		}
	}
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

	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/bg2.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>Samsung</span>
							<h2>Crack Screen</h2>
							<p>We repair Samsung edge Screen broken
							glass. with modern Machines operated  by one of the most experiance mechanics in the market  </p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<!--<a href="#" class="site-btn sb-white">ADD TO CART</a>-->
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h3>Rs.4000</h3>
						<h5>SHOP NOW</h5>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="img/bg4.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>IPhone</span>
							<h2>Crack Screen</h2>
							<p>We repair Iphone Screen broken
							glass. with modern Machines operated  by one of the most experiance mechanics in the market </p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<!--<a href="#" class="site-btn sb-white">ADD TO CART</a>-->
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h3>Rs.3000</h3>
						<h5>SHOP NOW</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->



	<!-- Features section -->
	<section class="features-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/1.png" alt="#">
						</div>
						<h2>Genuine Accessories</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/2.png" alt="#">
						</div>
						<h2>Premium Products</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/3.png" alt="#">
						</div>
						<h2>Fast Delivery</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->

	<!-- Recommended product section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>RECOMMENDED PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">

				<!-- Latest Product Dynamic Fetching -->
				<?php

					$query_2 = "(SELECT * FROM `products` WHERE `brand_id` = :id1 ORDER BY `product_id` DESC LIMIT 2) UNION (SELECT * FROM `products` WHERE `brand_id` = :id2 ORDER BY `product_id` DESC LIMIT 2)";
					$stmt2 = $db->prepare($query_2);
					$stmt2->bindParam(':id1', $recom_array[0], PDO::PARAM_INT);
					$stmt2->bindParam(':id2', $recom_array[1], PDO::PARAM_INT);

					if($stmt2->execute())
					{
						while($row = $stmt2->fetch())
						{
							echo("<div class='product-item'>
								<input type='hidden' value=''".$row['product_id'].">
									<div class='pi-pic'>
										<div class='tag-new'>New</div>
										<a href='product.php?p_id=".$row['product_id']."'><img src='login/images/product_images/".$row['product_img1']."' alt='' style='height: 410px;'></a>
										<div class='pi-links'>
											<a href='add_to_cart.php?quan=1&p_id=".$row['product_id']."' class='add-card'><i class='flaticon-bag'></i><span>ADD TO CART</span></a>
										</div>
									</div>
									<div class='pi-text'>
										<h6>".$row['product_price']."</h6>
										<p>".$row['product_title']."</p>
									</div>
								</div>");
						}
					}

				?>
				
		</div>
	</section>
	<!-- recommended product section end -->


	<!-- letest product section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>LATEST PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">

				<!-- Latest Product Dynamic Fetching -->
				<?php

					$query = "SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 10";
					$stmt = $db->prepare($query);

					if($stmt->execute())
					{
						while($row = $stmt->fetch())
						{
							echo("<div class='product-item'>
								<input type='hidden' value=''".$row['product_id'].">
									<div class='pi-pic'>
										<div class='tag-new'>New</div>
										<a href='product.php?p_id=".$row['product_id']."'><img src='login/images/product_images/".$row['product_img1']."' alt='' style='height: 410px;'></a>
										<div class='pi-links'>
											<a href='add_to_cart.php?quan=1&p_id=".$row['product_id']."' class='add-card'><i class='flaticon-bag'></i><span>ADD TO CART</span></a>
										</div>
									</div>
									<div class='pi-text'>
										<h6>".$row['product_price']."</h6>
										<p>".$row['product_title']."</p>
									</div>
								</div>");
						}
					}

				?>
				
		</div>
	</section>
	<!-- letest product section end -->

	<!-- Product filter section -->
	<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>TOP SELLING PRODUCTS</h2>

				<div class="product-slider owl-carousel">

					<?php

						$query_1 = "SELECT * FROM `top_selling` ORDER BY `top_id` ASC LIMIT 6";
						$stmt_1 = $db->prepare($query_1);
						$selecting_product = array();
						if($stmt_1->execute())
						{
							while($row = $stmt_1->fetch())
							{
								array_push($selecting_product, $row['p_id']);
							}
						}

						for($i=0; $i<count($selecting_product); $i++)
						{
							$query_2 = "SELECT * FROM `products` WHERE `product_id` = ?";
							$stmt_2 = $db->prepare($query_2);
							$stmt_2->execute([$selecting_product[$i]]);

							if($stmt_2->execute())
							{
								while($row = $stmt_2->fetch())
								{
									echo("<div class='product-item'>
									<input type='hidden' value=''".$row['product_id'].">
										<div class='pi-pic'>
											<div class='tag-new'>New</div>
											<a href='product.php?p_id=".$row['product_id']."'><img src='login/images/product_images/".$row['product_img1']."' alt='' style='height: 410px;'></a>
											<div class='pi-links'>
												<a href='add_to_cart.php?quan=1&p_id=".$row['product_id']."' class='add-card'><i class='flaticon-bag'></i><span>ADD TO CART</span></a>
											</div>
										</div>
										<div class='pi-text'>
											<h6>".$row['product_price']."</h6>
											<p>".$row['product_title']."</p>
										</div>
									</div>");
								}
							}
						}
					?>
				</div>

			</div>
			
		</div>
	</section><hr>
	<!-- Product filter section end -->

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
