<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
define('title', 'Cart | E-Shopper');
include 'header.php';
//add to cart functionality   
//session_destroy();
if(isset($_POST['deleteAll'])){ 
	if(isset($_SESSION['cart'])){ 
	session_unset(); 
	echo "<script>alert('Cart is made empty!');</script>";
	}
}


if(isset($_POST['delete'])){
	if($_POST['id'] != ''){
		if(isset($_SESSION['cart'])){ 
			foreach($_SESSION['cart'] as $key => $value){
				//print_r($key)
				if($value['id'] == $_POST['id']){
					unset($_SESSION['cart'][$key]);
					unset($_SESSION['prodId']);
					echo "<script> alert('Item Removed'); </script>"; 
				}
			}
		}elseif(isset($_SESSION['prodId'])){
			echo "<script> alert('Session is not set'); </script>"; 
			unset($_SESSION['prodId']);
			session_unset();
		}
	}
}

if(isset($_SESSION['prodId'])){ 
	$sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$_SESSION[prodId]'");
			while($cartRows = mysqli_fetch_assoc($sql)){
        if(isset($_SESSION['cart'])){ 
			$items = array_column($_SESSION['cart'], 'product');
			$prod = $cartRows['product'];
			if(in_array($prod, $items)){	
				echo "<script>alert('Item already added');</script>";
					} else{
						$count = count($_SESSION['cart']);
						$_SESSION["cartItems"]=$count+1;
						$_SESSION['cart'][$count] = $cartRows;
						echo "<script>
						alert('Item added to cart'); 
						</script>"; 
					}
		}else{ 
			$_SESSION["cartItems"] = 1;
			$_SESSION['cart']['0'] = $cartRows;
			echo "<script>
			alert('Item added to cart');
			</script>"; 
		}
		}
	}


?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol>
				<li class="cart_delete">
							<form action="" method="POST">
							<input type="hidden" name="prodId" value="<?php echo $product['id']; ?>">
								<button name="deleteAll" class="cart_quantity_delete btn-warning" href=""><i class="fa fa-times"></i> Delete</button>
								</form>
							</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<?php
if(isset($_SESSION['cart'])){
    $total_price = 0;

?>	

				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
						<?php
						//echo "<pre>"; print_r($_SESSION['cart']); echo "</pre>"; 
							//foreach($sql as $product){
						 foreach($_SESSION['cart'] as $product){
							 echo "<pre>";
							 print_r($product);
        				?>
					<tbody>
						<tr>
							<td class="cart_product">
								<img src="admin/<?php echo $product['image']; ?>" alt="">
							</td>
							<td class="cart_description">
								<h4><?php echo $product['product']; ?></h4>
								<p>Web ID: <?php echo $product['short_description']; ?></p>
							</td>
							<td class="cart_price">
								<p>$<?php echo $product['mrp'];?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="number" name="quantity" value="<?php echo $product['qty']; ?>" min="1" max="10">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
							<?php		
								 //foreach($_SESSION['cart'] as $product){
								 $product_price = 1*$product['mrp'];?>
								<p class="cart_total_price">$<?php echo $product_price?></p>
							</td>
							<td class="cart_delete">
							<form action="" method="POST">
							<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
								<button type="submit" name="delete" class="cart_quantity_delete btn-danger"><i class="fa fa-times"></i> Delete</button>
								</form>
							</td>
						</tr>
						 <?php } ?>
					</tbody>
				</table>
				<?php
			}else{ 
echo "<h1 align=center style=color:orange>Your Cart Is Empty </h1> <br> ";
 } ?>

			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

<?php include 'footer.php'; ?>