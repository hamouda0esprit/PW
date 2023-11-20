<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link rel="stylesheet" href="../model/Ticket.scss">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<div class="main_container">
		
	
		<div class="left">
			<?php
			require_once("..\model\config.php");

			$bd = new config();
			$pdo = $bd::getConnexion();

			$idRec = $_POST["idReclamationC"];
			$description = $_POST["description"];
			$type = $_POST["type"];
			$idC = $_POST["idC"];
			$idL = $_POST["idL"];
			$prenom = "";
			$nom = "";
			
			try{
				if ($idL === ""){
					$query = $pdo->prepare("SELECT `nom`, `prenom` FROM `user` WHERE `ID` = '$idC'");
					
				}else{
					$query = $pdo->prepare("SELECT `nom`, `prenom` FROM `livreur` WHERE `idLivreur` = '$idL'");
				}
				
				$query->execute();
				$result = $query->fetchAll();
			}
			catch(PDOExcepion $e){
				echo "connection failed :". $e->getMessage();
			}
			foreach($result as $row){
	
			}
			
			?>
			<div class="box">
				<h2 class="title">Ticket Id :</h2>
				<p class="Ticket-id">#<?php echo $idRec ?></p>
				
				<h3 class="title">Name :</h3>
				<p class="text"><?php echo $row["prenom"] ?> <?php echo $row["nom"] ?></p>
				
				<h3 class="title">Type :</h3>
				<p class="text"><?php echo $type ?></p>
				
				<h3 class="title">Description :</h3>
				<p class="text"><?php echo $description ?></p>
			</div>
		</div>
			
		<div class="spacer"></div>
		
		<div class="right">
			<div class="box">
				<div class="top">
					
				</div>
				
				<div class="bottom">
					<form action="../controller/AddMessage.php" method="POST" class="form">
						<input type="text" class="message">
						<input type="submit" class="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>