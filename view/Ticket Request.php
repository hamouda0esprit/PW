<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../model/Ticket Request.scss">
	<script src="../model/Control.js"></script>
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
						
						</div>
					</div>
				</div>

				<div class="commande">
					<div class="box">
						<div class="content">
						
						</div>
					</div>
				</div>
			</div>

			<div class="Bottom">
				<div class="comment">

				</div>
			</div>
		</div>
		<!--select commandes
		<h1>Commande : </h1> <br>
		<div class="select-box">
			<select name="Commande" id="Commande">
				<option value="0" disabled hidden selected>Please choose a delivery</option>
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
			</select>
		</div>
			
		<h1>Description : </h1> <br>
			
		<textarea name="description" id="description" cols="30" rows="10"></textarea>
		
		<br>
		
		<div class="submit-container">
			<input type="submit" class="input-submit" placeholder="Submit">
		</div>
		-->
	</form>
</body>
