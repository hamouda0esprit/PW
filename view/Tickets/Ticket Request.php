<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../../model/Tickets/Ticket Request.scss">
	<script src="../../model/Tickets/Control.js"></script>
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

        $userID = "C1";
	?>
	<form action="../../controller/Tickets/AddRequest.php" method="POST" class="cf" onsubmit="return validateForm();">
		<!--select type-->
		<div class="main_container">
			<div class="Top">
				<h1 class="title">Create Ticket</h1>
			</div>

            <input type="text" hidden name="idP" value="<?php echo "$userID"?>">

			<div class="Middle">
				<div class="type">
					<div class="box">
						<div class="content">
							<h3 class="title"><i class="fa-solid fa-bullseye"></i> Type</h3>
							<div class="select-box">
								<select name="type" id="type" class="select" onchange="HideClass()">
									<option value="0" disabled hidden selected>Please choose a type</option>
									<option value="Technical">Technical</option>
									<option value="Payement">Payement</option>
									<option value="Support">Support</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="commande hidden">
					<div class="box">
						<div class="content">
							<h3 class="title"><i class="fa-solid fa-bullseye"></i> Commande</h3>
							<div class="select-box">
								<select name="Commande" id="commande" class="select">
									<option value="0" disabled hidden selected>Please choose a delivery</option> 
									<?php
										try{
											$query = $pdo->prepare("SELECT * FROM `colis` WHERE `id_client` ='$userID'");
											$query->execute();
											$result = $query->fetchAll();
										}
										catch(PDOExcepion $e){
											echo "connection failed :". $e->getMessage();
										}
										foreach($result as $row){
									?>
										<option value="<?php echo $row["idcolis"]?>"><?php echo $row["idcolis"]?></option>
									<?php } ?>
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
						<textarea class="text" id="description" name="description"></textarea>
						<input type="submit" Value='Create Ticket' class="button">
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<div class="splitter_line">
		<div class="line"></div>
	</div>
	
	<div class="secondary_container">
		<?php
			try{
				$query = $pdo->prepare("SELECT `idReclamationC`, `idP`, `idCommande`, `type`, `description` FROM `reclamationc` WHERE `status` = '0' AND `idP` ='$userID'");
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
					
					<div class="bottom">
						<form action="../../controller/Tickets/DeleteRequest.php" method="POST" class="form">
							<input type="text" hidden name="idReclamationC" value="<?php echo $row["idReclamationC"]?>">
							<input type="submit" Value='Delete' class="button">
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</body>
