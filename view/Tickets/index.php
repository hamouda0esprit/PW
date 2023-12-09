<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">

    <title>Index</title>

	<link rel="stylesheet" href="../../model/Tickets/index.scss">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../../model/Tickets/Index.js"></script>
</head>
<?php
    require_once ("../../model/Tickets/Navbar.php");
    navbar();
?>
<body>
	<?php
        require_once("../../model/Tickets/config.php");
	 
		$bd = new config();
        $pdo = $bd::getConnexion();
	?>

	<div class="Main_Container">
		<div class="first_container">
			<div class="box">
				<h1 class="text">Bridging the gap, One delivery at a time</h1>
			</div>
		</div>
		
		<div class="White_Line"></div>
		
		<div class="second_container hidden">
			<div class="left">
				<div class="main_text">
					<h3 class="title">Everyday life made easier.</h3>
					<p class="first">Whether your looking to deliver something or indeed or delivering something, we got your back !</p>
					<p class="second"><i class="fa-solid fa-check"></i>Choose your Transporter</p>
					<p class="second"><i class="fa-solid fa-check"></i>Schedule when it works for you</p>
					<p class="second"><i class="fa-solid fa-check"></i>Chat, pay, tip, and review all through one platform</p>
				</div>
			</div>
			
			<div class="right">
			
			</div>
		</div>
		
		<div class="third_container hidden">
			<div class="top">
				<h1 class="title">Featured Delivery Drivers</h1>
			</div>
			
			<div class="bottom">
			<?php
				try{
					$query = $pdo->prepare('SELECT `ID`, `nom`, `prenom`, `PositiveReview`, `CompletedTasks`, `Bio` FROM `Data`');
					$query->execute();
					$result = $query->fetchAll();
					
				}
				catch(PDOExcepion $e){
					echo "connection failed :". $e->getMessage();
				}
				foreach($result as $row){ if ( $row["ID"][0] == "L" && $row["CompletedTasks"] != 0){ $AvgPositiveReviews = number_format((float)(($row["PositiveReview"] / $row["CompletedTasks"]) * 100), 2, '.', ''); if ($AvgPositiveReviews>=15){
			?>
			<!---->
			
				<div class="FDD-box">
					<div class="top">
						<div class="pdp">
							<img src="../../Assets/index/6.jpg" class="image">
						</div>

						<div class="details">
							<h3 class="name"><?php echo $row["prenom"] . " " . $row["nom"]?> </h3>
							<p class="PReviews"><i class="fa-solid fa-star"></i><?php echo $AvgPositiveReviews . "%"?> positive reviews</p>
							<p class="TasksC"><i class="fa-solid fa-circle-check"></i><?php echo $row["CompletedTasks"]?> completed tasks</p>
						</div>
					</div>

					<hr>

					<div class="bottom">
						<p class="bio"><?php echo $row["Bio"]?></p>
					</div>
				</div>			<?php }}} ?>
			</div>
		</div>
		
		<div class="fourth_container hidden">
			<div class="left">
				
			</div>
			
			<div class="right">
				<div class="main_text">
					<h3 class="title">Easy Peer-To-Peer</h3>
					<p class="first">Easily find delivery jobs on the get go. Bid for jobs & Get to it !</p>
					<p class="second"><i class="fa-solid fa-check"></i>Easy interface for competitive bidding for delivery jobs.</p>
					<p class="second"><i class="fa-solid fa-check"></i>Rating system which provides many advantages and features</p>
					<p class="second"><i class="fa-solid fa-check"></i>Simple integrated chatting system with customers </p>
					<p class="second"><i class="fa-solid fa-check"></i>Several payment methods</p>
				</div>
			</div>
		</div>
		
		<div class="fifth_container hidden">
			<form action="">
				<div class="top">
					<h1 class="title">Ready to get started?</h1>
				</div>

				<div class="split">
					<div class="left">
						<div class="image"></div>
						<p class="text">Need an easy way to deliver your packages ? We got you !</p>
						<input type="submit" class="button" value="Client">
					</div>

					<div class="right">
						<div class="image"></div>
						<p class="text">Get exclusive offers and deliveries on daily bases.</p>
						<input type="submit" class="button" value="Delivery Driver">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>