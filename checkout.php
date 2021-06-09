<?php
//session_start();
define('title', 'Checkout | E-Shopper');
include 'header.php'; 
if(isset($_SESSION['cart'])){ 
	print_r($_SESSION);

}
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check chbvcb git config --global core.editor "code --wait"</li>
				</ol>
			</div><!--/breadcrums-->

<?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){ }?>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
							</form>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address*">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
<?php		 foreach($_SESSION['cart'] as $product){  ?>

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
								<p class="cart_quantity_input"> <?php echo $product['qty']; ?></p>
							</td>
							<?php } ?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td><h4> Cart Total </h4></td>
										<td>$ </td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">
      
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
  
</div>
	</section> <!--/#cart_items-->

<?php include 'footer.php'; ?>
