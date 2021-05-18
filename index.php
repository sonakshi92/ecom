<?php
require 'config/config.php';
if(isset($_GET['cat_id'])){
	$cat_id = $_GET['cat_id'];
	$query2 = mysqli_query($conn, "SELECT image, short_description, mrp FROM products WHERE category=$cat_id");
} else {
	$query2 = mysqli_query($conn, "SELECT image, short_description, mrp FROM products");
}
define('title', 'Home | E-Shopper');
include 'header.php'; 
?>

<form action="" method="POST">
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
							$result = mysqli_query($conn, "SELECT * FROM carousel");
							$i = 0;
							 //while($row = mysqli_fetch_assoc($result)) {
								//print_r($row);
							foreach ($result as $row) {
								$actives = '';
								if($i == 0) {
									$actives = 'active';
								}
							?>
							<li data-target="#slider-carousel" data-slide-to="<?php  $i; ?>" class="<?php echo $actives; ?>"></li>
							<?php  $i++; } ?>
						</ol>
						
						<div class="carousel-inner">
							<?php
							 $i = 0;
							 //while($row = mysqli_fetch_assoc($result)) {
								foreach($result as $row) {
								$actives = '';
								if($i == 0){
									$actives = 'active';
								}
							?>
							<div class="item <?php echo $actives; ?>">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Welcome to E-Shoper</h2>
									<p> Explore shopping </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="admin/<?php echo $row['image']; ?>" class="girl img-responsive" alt="" />
									<img src="admin/images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>	
							<?php $i++; } ?>	
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<?php include 'sidebar.php'; ?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
						$query = mysqli_query($conn, "SELECT image, short_description, mrp FROM products");
						
						for($i=0; $row = mysqli_fetch_assoc($query); $i++){
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="admin/<?php echo $row['image']; ?>" alt="product"/>
											<h2>$ <?php echo $row['mrp']; ?></h2>
											<p> <?php echo $row['short_description']; ?> </p>
											<a href="cart.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
											<h2>$ <?php echo $row['mrp']; ?></h2>
											<p> <?php echo $row['short_description']; ?> </p>
											<a href="cart.php" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
                        <?php if($i==5){break;} } ?>	
						
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">						
							<ul class="nav nav-tabs">
							<?php
							 $result2 = mysqli_query($conn, "SELECT * FROM categories");
							 $i = 0;
								foreach($result2 as $row) {
								$actives = '';
								if($i == 0){
									$actives = 'active';
								}
							?>
								<li class="<?php echo $actives ?>"><a href="index.php?cat_id=<?php echo $row['id']; ?>" target="_self" data-toggle="tab"><?php echo $row['category']; ?></a> </li>
								<?php $i++; } ?>	
										</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt" >
								<?php foreach($query2 as $row) {  ?>
											<div class="col-sm-3">								
									<div class="product-image-wrapper">
										<div class="single-products">
												<img src="admin/<?php echo $row['image']; ?>" alt="" />
									<li><a href="shop.php?bid=<?php echo $row['id']; ?>"> 
												<h2>$ <?php echo $row['mrp']; ?></h2>
												<p> <?php echo $row['short_description'];?></p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="admin/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>												
											</div>
										</div>
									</div>									
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
				</div>
			</div>
		</div>
	</section>
	</form>
<?php include 'footer.php'; ?>