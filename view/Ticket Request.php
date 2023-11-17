<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../model/Ticket Request.css">
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
		<h1>Type : </h1> <br>
		<div class="select-box">
			<select name="type" id="type">
				<option value="0" disabled hidden selected>Please choose a type</option>
				<option value="Technical">Technical</option>
				<option value="Payement">Payement</option>
				<option value="Support">Support</option>
			</select>
		</div>
		
		<br>
		
		<!--select commandes-->
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
		
	</form>
</body>