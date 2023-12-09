<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../../model/Tickets/Ticket Manage - Admin.scss">
	<script src="../../model/Control.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                if ($idDelivery == "NULL"){
                    $query = $pdo->prepare("SELECT * FROM `reclamationc` WHERE  `idP` = '$idUser' AND ISNULL(`idCommande`)");
                }else{
                    $query = $pdo->prepare("SELECT * FROM `reclamationc` WHERE  `idP` = '$idUser' AND `idCommande` = '$idDelivery'");
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
							<h2 class="text">Type : </h2>
						</div>
						<div class="box">
							<p class="type"><?php echo $row["type"]?></p>
						</div>
					</div>
					
					<div class="right">
						<div class="title">
							<h2 class="text">Delivery Id : </h2>
						</div>
						<div class="box">
							<p class="idcommande"><?php echo $row["idCommande"]?></p>
						</div>
					</div>
				</div>
				
				<div class="bottom">
					<div class="title">
						<h2 class="text">Description : </h2>
					</div>
					
					<div class="box">
						<p class="description"><?php echo $row["description"]?></p>
					</div>
				</div>
			</div>
			
			<div class="right">
				<div class="box">
					<div class="top">
						<form action="../Tickets/Ticket.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<input type="text" hidden name="idP" value="<?php echo $row["idP"]?>">
							<input type="text" hidden name="description" value="<?php echo $row["description"]?>">
							<input type="text" hidden name="type" value="<?php echo $row["type"]?>">
							<input type="submit" Value='Chat' class="button">
						</form>
					</div>
					
					<div class="middle">
						<form action="../../controller/Tickets/DeleteRequest.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<input type="submit" Value='Delete' class="button">
						</form>
					</div>
					
					<div class="bottom">
						<form action="../../controller/Tickets/UpdateRequest.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<?php if($row["Status"] == 0) { ?>
							<input type="submit" Value='Close Ticket' class="button">
							<?php }else{ ?>
							<input disabled Value='Closed Ticket' class="closed-button">
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</body>
