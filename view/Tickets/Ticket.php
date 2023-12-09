<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["idRec"] = $_POST["idReclamationC"];
    $_SESSION["description"] = $_POST["description"];
    $_SESSION["type"] = $_POST["type"];
    $_SESSION["idP"] = $_POST["idP"];
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ticket</title>
	<script src="../../model/Tickets/Control.js"></script>
	<link rel="stylesheet" href="../../model/Tickets/Ticket.scss">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php
    require_once ("../../model/Tickets/Navbar.php");
    navbar();
?>
<body>
	<div class="main_container">

		<div class="left">
			<?php
			require_once("../../model/Tickets/config.php");

			$bd = new config();
			$pdo = $bd::getConnexion();

            $idRec = isset($_SESSION["idRec"]) ? $_SESSION["idRec"] : "";
            $description = isset($_SESSION["description"]) ? $_SESSION["description"] : "";
            $type = isset($_SESSION["type"]) ? $_SESSION["type"] : "";
            $idUser = isset($_SESSION["idP"]) ? $_SESSION["idP"] : "";

            $prenom = "";
			$nom = "";

			try{
                $query = $pdo->prepare("SELECT * FROM `Data`");

				$query->execute();
				$result = $query->fetchAll();
			}
			catch(PDOExcepion $e){
				echo "connection failed :". $e->getMessage();
			}
			foreach($result as $row){
				$prenom = $row["prenom"];
				$nom = $row["nom"];
			}

			?>
			<div class="box">
				<h2 class="title">Ticket Id :</h2>
				<p class="Ticket-id">#<?php echo $idRec ?></p>

				<h3 class="title">Name :</h3>
				<p class="text"><?php echo $prenom ?> <?php echo $nom ?></p>

				<h3 class="title">Type :</h3>
				<p class="text"><?php echo $type ?></p>

				<h3 class="title">Description :</h3>
				<p class="text"><?php echo $description ?></p>
			</div>
		</div>

		<div class="right">
			<div class="box">
				<div class="top">
					<?php
						try{
							$query = $pdo->prepare("SELECT `idP`, `message`, `date` FROM `reclamationa` WHERE `idReclamationA` = '$idRec'");

							$query->execute();
							$result = $query->fetchAll();
						}
						catch(PDOExcepion $e){
							echo "connection failed :". $e->getMessage();
						}
						foreach($result as $row){
							$idP = $row["idP"];
							try{
							$query = $pdo->prepare("SELECT * FROM `data` WHERE `ID` = '$idP'");

							$query->execute();
							$result = $query->fetchAll();
							}
							catch(PDOExcepion $e){
								echo "connection failed :". $e->getMessage();
							}
							foreach($result as $row2){?>
								<p class="dateT"><?php echo $row["date"]?></p>
								<p class="name"><i class="fa-solid fa-user"></i> <?php echo $row2["prenom"]?> <?php echo $row2["nom"]?> : </p>
								<p class="message"><?php echo $row["message"]?></p>
						<?php }} ?>
				</div>

				<div class="bottom">
					<form action="../../controller/Tickets/AddMessage.php" method="POST" class="form">
						<input type="text" name="idRec" value="<?php echo $idRec ?>" hidden>
						<input type="text" class="message" name="message">
						<input type="text" id="input_datetime" name="Date" value="" hidden>
                        <button type="submit" class="button" onclick="insertDatetime()"> <i class="fa-solid fa-truck-ramp-box"></i> </button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>