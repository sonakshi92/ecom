<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }

define('title', 'Shop | E-Shopper');
include 'header.php';
require_once 'sidebar.php';
if(isset($_POST['addCart'])){
	$_SESSION['prodId'] = $_POST['id'];
   echo "<script>window.location.href='cart.php';</script>";
}

if(isset($_GET['cid'])){
	$cid = $_GET['cid'];
	$query2 = mysqli_query($conn, "SELECT image, product, short_description, mrp FROM products WHERE category=$cid");
} else {
	if(isset($_GET['bid'])){
		$bid = $_GET['bid'];
		$query2 = mysqli_query($conn, "SELECT image, product, short_description, mrp FROM products WHERE brand=$bid");
} else {
$query2 = mysqli_query($conn, "SELECT id, image, product, short_description, mrp FROM products");
	}
}

?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
                        <?php
                         while($row = mysqli_fetch_assoc($query2)){
                            // print_r($row);
                        ?>
						<form action="" method="POST" enctype="multipart/form-data">
						<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
                               
									<div class="productinfo text-center">
										<img src="admin/<?php echo $row['image']; ?>" alt="product" />
										<h2>$ <?php echo $row['mrp']; ?></h2>
										<p><?php echo $row['product']; ?></p>
										<input type="hidden" name="id" value="<? echo $row['id'];?>">
										<p> <?php echo $row['short_description']; ?> </p>
										<input type="hidden" name="id" value="<?php echo $row['id']?>">
										<button type="submit" name="addCart" class="btn btn-warning" style="width:100%;"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
	</form>

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
<?php include 'footer.php'; ?>