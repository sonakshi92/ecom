<?php
require 'config/config.php';

?>
	<section id="advertisement">
		<div class="container">
			<!-- <img src="images/shop/advertisement.jpg" alt="" /> -->
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
                            while($rows = mysqli_fetch_array($query1)){
                            ?>
								<div class="panel-heading">
									<h4 class="panel-title"><img src="admin/<?php echo $rows['image'];?>" width="100"><a href="shop.php?cid=<?php echo $rows['id']; ?>"><?php echo $rows['category']; ?></a></h4>
								</div>
                                <?php } ?>

							</div>
						</div><!--/category-productsr-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
							<?php 
									$query3 = mysqli_query($conn, "SELECT * FROM brands");
									while($rows = mysqli_fetch_assoc($query3)){ 
									$q1 = mysqli_query($conn, "SELECT id, brand FROM products WHERE brand='$rows[id]'");
									$count = mysqli_num_rows($q1);									
									?>	
								<ul class="nav nav-pills nav-stacked">
									<li><a href="shop.php?bid=<?php echo $rows['id']; ?>"> 
									<span class="pull-right">(<?php echo $count; ?>)</span>
									<?php echo $rows['brand']; ?></a></li>
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
				
