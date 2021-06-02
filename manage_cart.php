<?php
include 'header.php'; 

$pid=get_safe_value($conn,$_POST['pid']);
$qty=get_safe_value($conn,$_POST['qty']);
$type=get_safe_value($conn,$_POST['type']);

$obj=new add_to_cart();

if($type=='add'){
	$obj->addProduct($pid,$qty);
}

if($type=='remove'){
	$obj->removeProduct($pid);
}

if($type=='update'){
	$obj->updateProduct($pid,$qty);
}

echo $obj->totalProduct();
?>