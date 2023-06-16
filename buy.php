<?php
	$Array=$_POST[check];
	$i=1;
	$j=0;
	$k=0;
	while (!is_null($Array[$i][0])) {
		while (!is_null($Array[$i][$j])) {
			//productId陣列從0開始
			$productId[$k]=$Array[$i][$j];
			$j=$j+1;
			$k=$k+1;
		}
		$i=$i+1;
		$j=0;
	}
	// echo $productId;
	//運費50元
	$fee=50;
?>
<!-- 下單 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="images-re.png" type="image/x-icon">
	<title>下單</title>
	<style>
		body{
			margin: 0;
			background: #f5f5f5;
		}
		header{
			display: flex;
			background: #FF6070;
			height: 113px;
			margin-bottom: 40px;
		}
		.headers{
			width: 80%;
		}
		.logo{
			padding-top: 18px;
			margin-left: 55%;
		}
		.plpl{
			transition: all 1s;
			margin-left: 100px;
			margin-top: 32px;
		}
		.plpl:hover{
			transform: scale(1.05,1.05);
		}
		.sds{
			margin: 0 auto;
			width: 35px;
			height: 42px;
		}
		.link{
			/*margin-left: 7px;*/
			text-decoration: none;
			color: white;
		}
		h3{
			text-align: center;
		}
		main{
			margin: 0 auto;
			min-height: 500px;
			max-height: auto;
			width: 580px;
			background: white;
		}
		.sec{
			margin: 0 auto;
			min-height: 500px;
			max-height: auto;
			width: 520px;
		}
		#sum{
			line-height: 25px;
		}
		.dgh{
			height: 50px;
			width: 100%;
		}
		#ipo{
			margin: 0 auto;
			background: #ff6070;
			border: none;
			cursor: pointer;
			color: white;
		}
		#ipo:hover{
			color: #FDFEFE;
			background: #ff6090;
		}
		.rt{
			padding-top: 20px;
			margin: 0 auto;
			width: 100px;
			height: 30px;
		}
		footer{
			text-align: center;
			color: white;
			height: 64px;
			width: 100%;
			background: #555;
			margin-top: 100px;
		}
		#pm{
			padding-top: 20px;
		}
	</style>
</head>
<body>
	<header>
		<div class='headers'>
			<a class='home' href='home.php'>
				<img class='logo' src='icon/阿丸購物.png' width="200">
			</a>
			<p>
				<!-- <form class="search" action="visit.php">
					<input name="page" type="hidden" value="1">
					<input class="search_text" type="text" name="search">
					<button class="search_button">搜尋</button>
				</form> -->
			</p>
		</div>
		<div class="plpl">
			<div class="pgg">
				<?php
					session_start();
					echo "<a class='link' href='member.php'>";
					echo "<div class='sds'>";
					echo "<img class='icon' src='icon/會員.png' width='35' height='40'>";
					echo "</div>";
					echo "<div class='link_text'>";
					echo $_SESSION['account'];
					echo "</div>";
					echo "</a>";
				?>
			</div>
		</div>
	</header>
	<main>
		<section class="sec">
		<div class="container" id="checkout">
			<h3>結帳</h3>
		</div>
		<h3>訂單商品</h3>
		<form action="success.php" method="POST" class="container" id="form_item">
			<div>
				<?php
					session_start();
					$account=$_SESSION["account"];

					$conn = mysqli_connect('localhost','root','20001118','final');
					foreach ($productId as $id) {
						$product = "select * from (select * from cart where account='$account')as a where product_id = '$id'";
						$result = mysqli_query($conn,$product);
						$row = mysqli_fetch_array($result);
						// echo "ID:" . $row[product_id];
						echo "商品名稱：" . $row[product_name] . "&nbsp&nbsp/&nbsp&nbsp";
						echo "商品價格：" . $row[product_price] . "&nbsp&nbsp/&nbsp&nbsp";
						echo "商品數量：" . $row[count] . "<br><br>";
						$productSum+=$row[product_price]*$row[count];
						//POST 商品id 到success.php
						echo "<input type='hidden' name='id[]' value='". $id. "''>";
					}

					// echo "<input type='hidden' name='id[]' value="$row[product_id]">";
				?>
			</div>
			<div id="message">
				留言：<input type="text" name="message" class="input"><br><br>
			</div>
			<div id="delivery">
				寄送方式：<input type="radio" name="delivery" value="711" required>7-11&nbsp
				<input type="radio" name="delivery" value="familymart">全家&nbsp
				<input type="radio" name="delivery" value="hilife">萊爾富&nbsp
				<input type="radio" name="delivery" value="okmart">OK MART&nbsp
				<input type="radio" name="delivery" value="home">賣家宅配<br><br>
			</div>	
			<!-- 付款方式 -->
			<div id="pay">
				付款方式：<input type="radio" name="pay" value="cash" required>貨到付款&nbsp
				<input type="radio" name="pay" value="creditcard">信用卡/金融卡&nbsp
				<input type="radio" name="pay" value="installment">信用卡分期付款&nbsp
				<input type="radio" name="pay" value="transfer">銀行轉帳<br><br>
			</div>
			<div id="checkout">
				<div class="container" id="sum">
					<?php
						// $productSum = $productPrice * $productCount;
						echo "商品總金額：" . $productSum;
					?>
				</div>
				<div class="container" id="sum">
					<?php
						$totalFee=$fee*($i-1);
						echo "運費總金額：" . $totalFee;
					?>
				</div>
				<div class="container" id="sum">
					<?php
						$sum=$productSum+$totalFee;
						echo "總付款金額：" . $sum;
					?>
				</div>
				<!-- <input type="hidden" name="id[]" value='$productId'> -->
				<!-- 下單 -->
				<div class="dgh">
					<div class="rt">
						<input type="submit" name="submit" value="下訂單" id="ipo" style="width:100px;height:30px;">
					</div>
				</div>
				
			</div>
		</form>
		</section>
	</main>
	<footer>
		<!-- 版權宣告 -->
		<p id="pm">阿丸購物股份有限公司 &copy; 2021 WU-ZHI-YUAN  All Rights Reserved.</p> 
	</footer>
</body>
</html>