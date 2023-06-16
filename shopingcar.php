<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="images-re.png" type="image/x-icon">
	<title>購物車</title>
	<style>
		body{
			background: #f5f5f5;
			margin:0;
		}
		header{
			display: flex;
			background: #FF6070;
			height: 113px;
		}
		.headers{
			width: 80%;
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
		.link_text{
			height: 20px;
		}
		.logo{
			padding-top: 18px;
			margin-left: 55%;
		}
		#contains{
			margin: 0 auto;
			margin-top: 25px;
			width: 80%;
			min-height: 700px;
			max-height: auto;
		}
		.ss{
			background: white;
			margin-top: 20px;
		}
		.bbbb{
			width: 100%;
			display: flex;
			height: 30px;
			border-bottom: 3px solid #f5f5f5;
		}
		.fg{
			margin-top: 1px;
			float: right;
			width: 50px;
		}
		.p{
			width: 145px;
			padding-top: 3px;
			margin-left: 20px;
		}
		.che{
			display: flex;
			padding-top: 25px;
			padding-left: 20px;
			height: 50px;
			background: white;
		}
		#lk{
			margin-left: 5px;
			margin-right: 465px;
		}
		.lp{
			margin-right: 320px;
		}
		#fgp{

		}
		#dc{
			width: 17px;
			height: 17px;
		}
		.gggg{
			background: #f5f5f5;
		}
		.ffff{
			display: flex;
			margin-top: 10px;
		}
		.dddd{
			margin-left: 20px;
			background: white;
			height: 100px;
			width: 33%;
		}
		.dddd2{
			margin-left: 20px;
			background: white;
			height: 100px;
			width: 33%;
		}
		.p2{
			margin-left: 160px;
		}
		.p3{
			margin-left: 120px;
		}
		.checkdiv{
			margin-top: 33px;
			width: 100px;
		}
		#chk{
			width: 17px;
			height: 17px;
		}
		#btn{
			width: 200px;
			height: 35px;
			float: right;
			color: white;
			background: #ff6070;
			border: none;
			cursor: pointer;
		}
		#btn:hover{
			color: #FDFEFE;
			/*color: #D6F21C;*/
			background: #ff6090;
		}
		footer{
			text-align: center;
			color: white;
			height: 64px;
			width: 100%;
			background: #555;
			margin-top: 180px;

		}
		p{
			padding-top: 20px;
		}
	</style>
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
					echo $_SESSION['account']+'c';
					echo "</div>";
					echo "</a>";
					
				?>
			</div>
		</div>
	</header>
	<div id="contains">
		
		<?php
			session_start();
			$account=$_SESSION["account"];
			$shopingcar = mysqli_connect('localhost','root','20001118', "final");
			echo "<form name = 'form' method = 'POST' action = 'buy.php'>";
			if(!$shopingcar){
				echo "fail";
			}else{
				$sql = "select * from cart where account='$account' order by member_id , product_id"; 
				$result = mysqli_query($shopingcar,$sql);
				$savestore = "";
				$itemcount = 1;
				$money = 0;
				$i = 0;
				if(mysqli_num_rows($result) < 1){
					echo "購物車內沒東西";
				}else{
			?>
						
					<div class="che">全選<div id="lk"><input type='checkbox' id='dc' name='all' onclick='CheckAll(this,1)'/></div>
						數量<div class="lp"></div>單價
					</div><br>
					<?php
					echo "<div class='gggg'>";
					while($row[$i] = mysqli_fetch_array($result)){
						$i+=1;																						
					}
					for ($j=1; $j < count($row) ; $j++) { 
						echo "<div class='ss'>";
						
						if ($savestore != $row[$j-1][member_id]) {
								echo "<div class='bbbb'>";
								echo "<div class='p'>";
								echo "賣場編號：";
								echo $row[$j-1][member_id] . "";
								$storecount+=1;?>
								<div class="fg">
									<input type='checkbox' name='store' id="chk" onclick="check_store(this,'check[<?php echo $storecount; ?>][]')" group='1'/><br>
								</div>
								
								<?php
								$savestore = $row[$j-1][member_id];
								echo "</div>";
								echo "</div>";
						}
						
						if ($row[$j-1][product_id] == $row[$j][product_id] && $row[$j][member_id] == $row[$j-1][member_id]) {		
							$itemcount+=1;
						}else{						
							// echo $row[$j-1][img_url]." ".$row[$j-1][product_name] . "-" . $row[$j-1][product_detail] . " 價格: " . $row[$j-1][product_price] . " X" . $itemcount ;
							echo "<div class='ffff'>";
							echo "<div class='dddd'>"; 
							echo "<p>";
							echo $row[$j-1][product_name];
							echo "</p>";
							echo "</div>";
							echo "<div class='dddd2'>";
							echo "<p class='p2'>";
							echo $row[$j-1][count] . "&nbsp&nbsp";
							echo "</p>";
							echo "</div>";
							echo "<div class='dddd'>";
							echo "<p class='p3'>";
							echo "$ " . $row[$j-1][product_price];
							echo "</p>";
							echo "</div>";
							echo "<div class='checkdiv'>";
							echo "<input type='checkbox' id='chk' name='check[".$storecount."][]' value=".$row[$j-1][product_id]." group='1'><br>";
							echo "<input type='hidden' name='count[]' value=".$row[$j-1][count]." >";
							echo "</div>";
							echo "</div>";
						}
						echo "</div>";
					}
					echo "</div>";
					echo "<button id='btn' type='submit' name='下單' value='下單'>下單</button>";						
				}
			}?>
	</div>
	
	<footer>
    	<p>阿丸購物股份有限公司 &copy; 2021 WU-ZHI-YUAN  All Rights Reserved.</p> 
  	</footer>
	</form>
	<?php mysql_connect("111.249.18.20", "admin", "B10809027", "final").close();
	?>
	
</body>
</html>
