<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../model/Ticket Request.scss">
	<script src="../model/Control.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php
        require_once("..\model\config.php");
	
		$bd = new config();
        $pdo = $bd::getConnexion();
	?>
	<form action="../model/AddRequest.php" method="POST" class="cf" onsubmit="return validateForm()">
		<!--select type-->
		<div class="main_container">
			<div class="Top">
				<h1 class="title">Create Ticket</h1>
			</div>

			<div class="Middle">
				<div class="type">
					<div class="box">
						<div class="content">
							<h3 class="title"><i class="fa-solid fa-bullseye"></i> Type</h3>
							<div class="select-box">
								<select name="" id="type" class="select">
									<option value="0" disabled hidden selected>Please choose a type</option>
									<option value="Technical">Technical</option>
									<option value="Payement">Payement</option>
									<option value="Support">Support</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="commande">
					<div class="box">
						<div class="content">
							<h3 class="title"><i class="fa-solid fa-bullseye"></i> Commande</h3>
							<div class="select-box">
								<select name="" id="commande" class="select">
									<option value="0" disabled hidden selected>Please choose a delivery</option>
									
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="Bottom">
				<div class="comment">
					<div class="box">
						<h1 class="title">Comment</h1>
						<textarea class="text" id="description"></textarea>
						<input type="submit" Value='Create Ticket' class="button">
					</div>
				</div>
			</div>
		</div>
	</form>
		<!--select commandes

				<?php
					try{
						$query = $pdo->prepare('SELECT `idDeliveries` FROM `activedeliveries`');
						$query->execute();
						$result = $query->fetchAll();
					}
					catch(PDOExcepion $e){
						echo "connection failed :". $e->getMessage();
					}
					foreach($result as $row){
				?>
					<option value="<?php echo $row["idDeliveries"]?>"><?php echo $row["idDeliveries"]?></option>
				<?php } ?>

		-->
		
	
</body>
