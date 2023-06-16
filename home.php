<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<link rel="icon" href="images-re.png" type="image/x-icon">
	<title>阿丸購物</title>
	<link rel="stylesheet" type="text/css" href="visit.css">
</head>
<body>
	<header>
		<div class='header'>
			<a class='home' href='home.php'>
				<img class='logo' src='icon/阿丸購物.png'>
			</a>
			<p>
				<form class="search" action="visit.php">
					<input name="page" type="hidden" value="1">
					<input class="search_text" type="text" name="search">
					<button class="search_button">搜尋</button>
				</form>
			</p>
			<a class='link' href='shopingcar.php'>
				<img class='icon' src='icon/購物車.png'>
				<div class='link_text'>購物車</div>
			</a>
			<?php
				session_start();
				if ($_SESSION['account'] != ''){
					echo "<a class='link' href='member.php'>";
					echo "<img class='icon' src='icon/會員.png'>";
					echo "<div class='link_text'>";
					echo $_SESSION['account'];
					echo "</div>";
					echo "</a>";
				}else{
					echo "<a class='link' href='signin.php'>";
					echo "<img class='icon' src='icon/會員.png'>";
					echo "<div class='link_text'>";
					echo '登入/註冊';
					echo "</div>";
					echo "</a>";
				}
			?>
		</div>
	</header>
	<div class='banner'><img src='icon/banner.png'></div>
	<div class='content'>
		<div class = 'title'>
			<div class='line'></div>
			<a>所有商品</a>
		</div>
		<!-- '111.248.159.121','admin','B10809027' -->
		<?php
			$conn = mysqli_connect('localhost','root','20001118','final');
			$sql = 'SELECT * FROM product';
			$result = mysqli_query($conn,$sql);
			$page_num = 0;
			$num_rows = 0;
			while(mysqli_fetch_array($result)){
				$num_rows += 1;
			}

			if($num_rows%16 == 0){
				$page_num = $num_rows / 16;
			}else{
				$page_num = (int)($num_rows / 16)+1;
			}

			$sql2 = 'SELECT * FROM product LIMIT 16';
			$all_product = mysqli_query($conn,$sql2);

			for ($i = 0; $i <= 3; $i++) {
				echo '<div class="pd_row">';

				for ($j = 0; $j <= 3; $j++) {
					if (!$each_product = mysqli_fetch_array($all_product)){
						break;
					}
					echo '<div class = "product">';
					// echo '<a href='final_product.php?pd_id=$pd_id'>';
					echo '<a href="merchandise.php?pd_id='.$each_product[product_id].'">';

					echo '<div class="pd_img_frame">';
					echo "<img class='pd_img' src='$each_product[img_url]'>";
					echo '</div>';

					echo '<div class="pd_name">'.mb_strimwidth($each_product[product_name],0,45,' ...','UTF-8').'</div>';

					echo '<div class="pd_info">';
					echo '<div class="pd_price">$'.$each_product[product_price].'</div>';
					echo '<div class="pd_sold">已售出：'.$each_product[product_sold].'</div>';
					echo '</div>';

					echo '</a> ';
					echo '</div>';
				}
				echo '</div>';
			}
		?>
		<a href='visit.php?page=1'>
			<div class = 'more'>查看更多</div>
		</a>
	</div>
	<footer>
    	阿丸購物股份有限公司 &copy; 2021 WU-ZHI-YUAN  All Rights Reserved.
  	</footer>
</body>
</html>