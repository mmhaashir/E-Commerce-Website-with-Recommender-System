<?php

	include("login/includes/db.php");
	include("includes/cart.php");
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


	<br><br>

	<div class="conatiner-fluid">
		<div class="row mx-auto" style="max-width: 100%; overflow-x: hidden;">
			<!-- Main Section -->
			<?php
				$row_count = 0;
				$col_count = 4;
				$query = "SELECT * FROM `brands`";
				$stmt = $db->prepare($query);
				if($stmt->execute())
				{
					while($row = $stmt->fetch())
					{
						echo("
								<div class='card mx-auto' style='width: 18rem;'>
								  <div class='card-body mx-auto' style='text-align: center;'>
								    <h5 class='card-title'>".$row['brand_title']."</h5>
								    <p class='card-text'>".$row['brand_desc']."</p><br>
								    <div class='mx-auto' style='text-align: center;'><a href='brands_products.php?brand_id=".$row['brand_id']."'>Visit</a></div>
								  </div>
								</div>
								
							");

						$row_count++;
    					if($row_count % $col_count == 0) echo '</div><br><div class="row mx-auto">';
					}

					
				}

			?>
		</div>
	</div>
	<br>
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
