<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script type="text/javascript">
		function check_store(obj,check){
			var checkboxsc = document.getElementsByName(check);
			for(var i=0;i<checkboxsc.length;i++){
		    	checkboxsc[i].checked = obj.checked;
		    }	    
		}
		function CheckAll(ckAll,group) {
 			var e = document.forms[0].elements;
 			for (var i=0;i<e.length;i++){
				e[i].checked = ckAll.checked;
			}
		}
	</script>
</head>
<body>
	<?php 
	session_start();
	$shopingcar = mysqli_connect('localhost','root','20001118','final');
	?>
	<form name = "form" method = 'POST' action = 'post2.php'>
	<?php
	if(!$shopingcar){
		echo "fail";
	}else{
		$sql = "select * from cart order by account , product_id"; 
		$result = mysqli_query($shopingcar,$sql);
		$savestore = "";
		$itemcount = 1;
		$money = 0;
		$i = 0;
		if(!$result){
			echo "購物車內沒東西";
		}else{
			?>
			全選<input type='checkbox' name='all' onclick='CheckAll(this,1)'/><br>
			<?php
			while($row[$i] = mysqli_fetch_array($result)){
				$i+=1;																						
			}
			for ($j=1; $j < count($row) ; $j++) { 
				if ($savestore != $row[$j-1][account]) {
						echo $row[$j-1][account] ;
						$storecount+=1;?>
						<input type='checkbox' name='store' onclick="check_store(this,'check[<?php echo $storecount; ?>][]')" group='1'/><br>
						<?php
						$savestore = $row[$j-1][account];
				}
				if ($row[$j-1][product_id] == $row[$j][product_id] && $row[$j][account] == $row[$j-1][account]) {		
					$itemcount+=1;
				}else{						
					echo $row[$j-1][img_url].$row[$j-1][product_name] . "-" . $row[$j-1][product_detail] . " 價格: " . $row[$j-1][product_price] . " X" . $itemcount ;
					$money+=$row[$j-1][product_price];
					echo "<input type='checkbox' name='check[".$storecount."][]' value=".$row[$j-1][product_id].$itemcount." group='1'><br>";
				}
			}
			echo "總計:".$money."<br>";						
		}
	}?>
	<?php  
	
		$sqlss = "select * from cart where product_id = '2'";
		
		$resultss = mysqli_query($shopingcar,$sqlss);
		echo "<br><br>";
		while ($rowss = mysqli_fetch_array($resultss)) {
		echo "Product_id：" . $rowss[product_id] . "<br>";
		echo "Member_id：" . $rowss[member_id] . "<br>";
		echo "商品名稱：" . $rowss[product_name] . "<br>";
		echo "全部數量：" . $rowss[product_count] . "<br>";
		echo "賣出數量：" . $rowss[product_sold] . "<br>";
		echo "剩餘數量：" . $rowss[product_left] . "<br>";
		echo "商品價格：" . $rowss[product_price] . "<br>";
		echo "商品type：" . $rowss[product_type] . "<br>";
		echo "詳細：" . $rowss[product_detail] . "<br>";

		}
	?>
	<input type='submit' name='下單' value="下單">
	</form>
	<?php mysql_connect("localhost", "root", "s21627168a", "shopping").close();
?>
</body>
</html>

