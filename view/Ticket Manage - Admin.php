<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../model/Ticket Manage - Admin.scss">
	<script src="../model/Control.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php
        require_once("..\model\config.php");
	
		$bd = new config();
        $pdo = $bd::getConnexion();
	?>
	<div class="main_container" style="height:6vw;">
		<div class="Top">
            <h1 class="title">Manage Request - Admin</h1>
        </div>
	</div>
	
	<div class="secondary_container">
		<?php
                $selectedType = $_POST["selectedType"];
                $idUser = $_POST["idUser"];
                $idDelivery = $_POST["idDelivery"];
				
			try{
				if ($selectedType == "Client") {
                	$query = $pdo->prepare("SELECT `idReclamationC`, `idC`, `idL`, `idCommande`, `type`, `description` FROM `reclamationc` WHERE  `idC` = '$idUser' AND `idCommande` = '$idDelivery' AND `status` = '0' ");
                } elseif ($selectedType == "DeliveryDriver") {
					$query = $pdo->prepare("SELECT `idReclamationC`, `idC`, `idL`, `idCommande`, `type`, `description` FROM `reclamationc` WHERE  `idL` = '$idUser' AND `idCommande` = '$idDelivery' AND `status` = '0' ");
                }
				
				$query->execute();
				$result = $query->fetchAll();
			}
			catch(PDOExcepion $e){
				echo "connection failed :". $e->getMessage();
			}
			foreach($result as $row){
		?>
		<div class="ticket">
			<div class="left">
				<div class="box">
					<h1 class="id">#<?php echo $row["idReclamationC"]?></h1>
				</div>
			</div>
			
			<div class="middle">
				<div class="top">
					<div class="left">
						<div class="title">
							<h3 class="text">Type : </h2>
						</div>
						<div class="box">
							<p class="type"><?php echo $row["type"]?></p>
						</div>
					</div>
					
					<div class="right">
						<div class="title">
							<h3 class="text">Delivery Id : </h2>
						</div>
						<div class="box">
							<p class="idcommande"><?php echo $row["idCommande"]?></p>
						</div>
					</div>
				</div>
				
				<div class="bottom">
					<div class="title">
						<h3 class="text">Description : </h2>
					</div>
					
					<div class="box">
						<p class="description"><?php echo $row["description"]?></p>
					</div>
				</div>
			</div>
			
			<div class="right">
				<div class="box">
					<div class="top">
						<form action="Ticket.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<input type="text" hidden name="idC" value="<?php echo $row["idC"]?>">
							<input type="text" hidden name="idL" value="<?php echo $row["idL"]?>">
							<input type="text" hidden name="description" value="<?php echo $row["description"]?>">
							<input type="text" hidden name="type" value="<?php echo $row["type"]?>">
							<input type="submit" Value='Chat' class="button">
						</form>
					</div>
					
					<div class="middle">
						<form action="../controller/DeleteRequest.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<input type="submit" Value='Delete' class="button">
						</form>
					</div>
					
					<div class="bottom">
						<form action="../controller/UpdateRequest.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<input type="submit" Value='Close Ticket' class="button">
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</body>