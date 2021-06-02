<?php
define('title', 'View Categories');
include 'header.php';
//session_start();
$adminSession = $_SESSION['admin_email'];
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($conn,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($conn, $_GET['operation']);
		$id=get_safe_value($conn, $_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update categories set status='$status' where id='$id'";
		mysqli_query($conn,$update_status_sql);
	}
}
    if(isset($_GET['delete'])){
    $id = get_safe_value($conn, $_GET['delete']);
    $sql = "DELETE FROM categories WHERE id=$id";
    $del = mysqli_query($conn, $sql);
    echo "Record Deleted";
}

?>

<div class="container">

    <table class="table table-hover table-striped" id="list">
        <thead class="table-dark">
            <tr>
                <th scope="col"> S.No. </th>
                <th scope="col"> Category </th>
                <th scope="col"> Image </th>
                <th scope="col"> Description </th>
                <th scope="col"> Status </th>
                <th scope="col"> Action </th>

            </tr>
        </thead>
        <?php
            $query = mysqli_query($conn, "SELECT * FROM categories ORDER BY category desc");
            $i=1;
            while($rows = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><b><?php echo $i; ?></b></td>
                <td><b><?php echo $rows['category']; ?></b></td>
                <td><img src="<?php echo $rows['image']; ?>" width=100></td>
                <td><i><?php echo $rows['description']; ?></i></td>
                <td><i><?php 
                       if($rows['status']==1){
                        echo "<a href='?type=status&operation=deactive&id=".$rows['id']."'>Active</a>&nbsp;";
                         }else{
                         echo "<a href='?type=status&operation=active&id=".$rows['id']."'>Deactive</a>&nbsp;";
                        }
                        ?></i></td>
                
                <td>
                    <a href="category_add.php?edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm a-btn-slide-text">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>        

                    <a href="categories_list.php?delete=<?php echo $rows['id']; ?>"class="btn btn-danger btn-sm a-btn-slide-text">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a>
        </td>
            </tr>
            
        <?php $i++; } ?>
    </table>
<script>
$(document).ready( function(){
    $('#list').DataTable();
});
</script>
</body>
</html>