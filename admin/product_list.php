<?php
//if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
define('title', 'Customise Your Product');
include 'header.php';
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn,$_GET['operation']);
		$id=get_safe_value($conn,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update products set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    $del = mysqli_query($conn, $sql);
    echo "Record Deleted";
}

 ?>

<div class="container">
<div class="row justify-content-container">


<form action="" method="POST">
<input type="hidden" name="id" value="<?php echo $id;?>">

<?php 

$sql = mysqli_query($conn, "SELECT a.id, a.product, a.category, a.image, a.sku , a.short_description, a.description, a.quantity, a.purchase_price, a.mrp, a.status, b.category, c.brand FROM products as a 
left join categories as b
on a.category = b.id
left join brands as c
on a.brand = c.id");


?>

<table class="table table-bordred table-striped" id="view">
<thead>
    <tr style="color:tomato">
        <th> <h3> Products </h3> </th>
        <th> <h3> Category </h3> </th>
        <th> <h3> Brand </h3> </th>
        <th> <h3> Image </h3> </th>
        <th> <h3> SKU </h3> </th>
        <th> <h3> Description </h3> </th>
        <th> <h3> Quantity </h3> </th>
        <th> <h3> Price </h3> </th>
        <th><h3>  status </h3> </th>
        <th><h3>  Action </h3> </th>
    </tr>
</thead>

<tbody>   
          <?php while($rows = mysqli_fetch_assoc($sql)) { ?>
    <tr>
        <td>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <b><?php echo $rows['product'];?></b>
        </td>
        <td>
            <i><?php echo $rows['category'];?></i>
        </td>
        <td>
            <i><?php echo $rows['brand'];?></i>
        </td>
        <td>
            <img src="<?php echo $rows['image']; ?>" alt="Product Image" width=50>
        </td>
        <td>
            <i><?php echo $rows['sku']; ?></i>
        </td>
        <td>
            <i><?php echo $rows['short_description']; ?></i>
        </td>
        <td>
            <i><?php echo $rows['quantity'];?></i>
        </td>
        <td>
            <i><?php echo $rows['mrp'];?></i>
        </td>
        <td>
        <?php
			if($rows['status']==1){
			    echo "<a href='?type=status&operation=deactive&id=".$rows['id']."'>Active</a>&nbsp;";
			}else{
				echo "<a href='?type=status&operation=active&id=".$rows['id']."'>Deactive</a>&nbsp;";
				}					
        ?>
        </td>

        <td>
            <a href="product_edit.php?edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm a-btn-slide-text">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
            <a href="product_list.php?delete=<?php echo $rows['id']; ?>"class="btn btn-danger btn-sm a-btn-slide-text">
         <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Delete</a>
        </td>
    </tr> 
    <?php  }?>
    </tbody>
</table>
</form>
<script>
$(document).ready( function () {
    $('#view').DataTable();
} );
</script>

</div></div>
</body>
</html>