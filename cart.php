<?php
require 'config/config.php';
if(isset($_GET['product_id'])){
	$product_id = $_GET['product_id'];
	$query2 = mysqli_query($conn, "SELECT id, image, product, short_description, mrp FROM products WHERE id='$product_id'");
//	while($row = mysqli_fetch_array($query2)){
	//	$itemArray = array($query2[0]["product_id"]=>array('name'=>$query2[0]["name"], 'product_id'=>$query2[0]["product_id"], 'quantity'=>$_POST["quantity"], 'price'=>$query2[0]["price"], 'image'=>$$query2[0]["image"]));
		if (!empty($_SESSION['cart'])){
	//		if(in_array($query2[0]["product_id"],array_keys($_SESSION["cart"]))) {
	//			foreach($_SESSION["cart"] as $k => $v) {
	//					if($query2[0]["product_id"] == $k) {
	//						if(empty($_SESSION["cart"][$k]["quantity"])) {
	//							$_SESSION["cart"][$k]["quantity"] = 0;
	//						}
	//						$_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
	//					}
	//			}
	//		} else {
	//			$_SESSION["cart"] = array_merge($_SESSION["cart"],$itemArray);
	//		}

	//	}
	//	else{
	//		$_SESSION['cart'] = $row;
	//	}
	//}
	$_SESSION['product_id'] = $product_id;
	//$cart = "INSERT INTO cart (product_id) VALUES('$product_id')";
	$add = mysqli_query($conn, $cart);
	//header('location:cart.php');
}}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM cart WHERE id=$id";
    $del = mysqli_query($conn, $sql);
    echo "Record Deleted";
}

define('title', 'Cart | E-Shopper');
include 'header.php';
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
           				 //$query = mysqli_query($conn, "SELECT * FROM cart");
			          	 while($rows = mysqli_fetch_array($query2)){
        				?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="admin/<?php $rows['image']; ?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php $row['product']; ?></a></h4>
								<p>Web ID: <?php $row['id']; ?></p>
							</td>
							<td class="cart_price">
								<p>$<?php $row['mrp'];?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$<?php $quantity * $mrp?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i>delete</a>
							</td>
						</tr>
						 <?php } ?>
					</tbody>
				</table>
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