<?php
	$productId=$_POST[id];
	echo $productId[0] . "<br>";
	session_start();
	$account=$_SESSION["account"];
	$conn = mysqli_connect('localhost','root','20001118','final');
	foreach ($productId as $id) {
		$cart = "select * from (select * from cart where account='$account')as a where product_id = '$id'";
		$result = mysqli_query($conn,$cart);
		$row = mysqli_fetch_array($result);
		
		$products = "select * from product where product_id = '$id'";
		$productResult = mysqli_query($conn,$products);
		$productRow = mysqli_fetch_array($productResult);
		$left = $productRow[product_left]-$row[count];
		$sold = $productRow[product_sold]+$row[count];
		
		$product = "update product set product_left = '$left', product_sold = '$sold' where product_id = '$id'";
		$result2 = mysqli_query($conn,$product);
	}
	echo "<script>alert('已下單完成');location.href = 'home.php';</script>";
?>