<?php
require 'config/config.php';
if(isset($_GET['cid'])){
	$cid = $_GET['cid'];
   $query2 = mysqli_query($conn, "SELECT image, short_description, mrp FROM products WHERE category=$cid");
} else {
	$query2 = mysqli_query($conn, "SELECT image, short_description, mrp FROM products");
}


define('title', 'Categories| E-Shopper');
include 'header.php'; ?>

<form action="" method="POST">
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
                            <?php 
                            $query1 = mysqli_query($conn, "SELECT * FROM categories");
                            while($rows = mysqli_fetch_array($query1)){ ?>
								<div class="panel-heading">
									<?php ?>
									<h4 class="panel-title"><a href="categories.php?cid=<?php echo $rows['id']; ?>"><?php echo $rows['category']; ?></a></h4>
								</div>
                                <?php } ?>

							</div>
						</div><!--/category-productsr-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
							<?php 
									while($rows = mysqli_fetch_array($query3)){ 
									$q1 = mysqli_query($conn, "SELECT id, brand FROM products WHERE	brand='$bid'");
									$count = mysqli_num_rows($q1);
									
									?>	
								<ul class="nav nav-pills nav-stacked">
									<li><a href="categories.php?bid=<?php echo $rows['id']; ?>"> <span class="pull-right">(<?php echo $count; ?>)</span><?php echo $rows['brand']; ?></a></li>
								</ul>
								<?php } ?>	

							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
                        <?php
						
                         while($row = mysqli_fetch_assoc($query2)){
                            // print_r($row);
                        ?>
						<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
                               
									<div class="productinfo text-center">
										<img src="admin/<?php echo $row['image']; ?>" alt="product" />
										<h2>$ <?php echo $row['mrp']; ?></h2>
										<p><?php echo $row['short_description']; ?></p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>

									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$ <?php echo $row['mrp']; ?></h2>
											<p> <?php echo $row['short_description']; ?> </p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
                        <?php } ?>	

						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	</form>
<?php include 'footer.php'; ?>