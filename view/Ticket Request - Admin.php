<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ticket Request</title>
	<link rel="stylesheet" href="../model/Ticket Request - Admin.scss">
	<script src="../model/Control - Admin.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<?php
        require_once("..\model\config.php");
	
		$bd = new config();
        $pdo = $bd::getConnexion();
	?>
	
	<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["type"])) {
    $_SESSION["selectedType"] = $_POST["type"];
    $_SESSION["selectedUser"] = isset($_POST["User"]) ? $_POST["User"] : "0"; // Default value if not set

    // Unset the session variable for the third select on form submission
    unset($_SESSION["selectedCommande"]);
}

// Check if the session variable is set
if (isset($_SESSION["selectedType"])) {
    $selectedType = $_SESSION["selectedType"];
    $selectedUser = $_SESSION["selectedUser"];
    $selectedCommande = isset($_SESSION["selectedCommande"]) ? $_SESSION["selectedCommande"] : "0"; // Default value if not set
} else {
    $selectedType = "0"; // Default value if not set
    $selectedUser = "0"; // Default value if not set
    $selectedCommande = "0"; // Default value if not set
    unset($_SESSION["selectedType"]);
    unset($_SESSION["selectedUser"]);
    unset($_SESSION["selectedCommande"]);
}
?>

<form action="../view/Ticket Request - Admin.php" method="POST" class="cf">
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
                            <select name="type" id="type" class="select" onchange="this.form.submit()">
                                <option value="0" disabled hidden <?php echo ($selectedType == "0") ? "selected" : ""; ?>>Please choose a type</option>
                                <option value="Client" <?php echo ($selectedType == "Client") ? "selected" : ""; ?>>Client</option>
                                <option value="DeliveryDriver" <?php echo ($selectedType == "DeliveryDriver") ? "selected" : ""; ?>>Livreur</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="User">
                <div class="box">
                    <div class="content">
                        <h3 class="title"><i class="fa-solid fa-bullseye"></i> User</h3>
                        <div class="select-box">
                            <select name="User" id="User" class="select" onchange="this.form.submit()">
                                <option value="0" disabled hidden <?php echo ($selectedUser == "0") ? "selected" : ""; ?>>Please choose a delivery</option>
                                <?php
                                try {
                                    if ($selectedType == "Client") {
                                        $query = $pdo->prepare('SELECT * FROM `user`');
                                    } elseif ($selectedType == "DeliveryDriver") {
                                        $query = $pdo->prepare('SELECT * FROM `livreur`');
                                    }

                                    // Execute the query
                                    $query->execute();
                                    $result = $query->fetchAll();
                                } catch (PDOException $e) {
                                    echo "Connection failed: " . $e->getMessage();
                                }

                                foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo ($selectedType == "DeliveryDriver") ? $row["idLivreur"] : $row["ID"]; ?>" <?php echo ($selectedUser == ($selectedType == "DeliveryDriver" ? $row["idLivreur"] : $row["ID"])) ? "selected" : ""; ?>><?php echo $row["prenom"] ?> <?php echo $row["nom"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="Bottom">
            <div class="Commande">
                <div class="box">
                    <div class="content">
                        <h3 class="title"><i class="fa-solid fa-bullseye"></i> Commande</h3>
                        <div class="select-box">
                            <select name="Commande" id="commande" class="select">
                                <option value="0" disabled hidden <?php echo ($selectedCommande == "0") ? "selected" : ""; ?>>Please choose a delivery</option>
                                <?php
                                try {
                                    if ($selectedType == "Client") {
                                        $query = $pdo->prepare('SELECT * FROM `activedeliveries` WHERE `idDeliveries` = :selectedId');
                                    } elseif ($selectedType == "DeliveryDriver") {
                                        $query = $pdo->prepare('SELECT * FROM `bids` WHERE `idDeliveries` = :selectedId');
                                    }

                                    $query->bindParam(':selectedId', $selectedId);
                                    $selectedId = ($_POST["User"]) ? $_POST["User"] : 0; // Use the selected value from the second dropdown

                                    // Execute the query
                                    $query->execute();
                                    $result = $query->fetchAll();
                                } catch (PDOException $e) {
                                    echo "Connection failed: " . $e->getMessage();
                                }
								if (!empty($result)) {
									foreach ($result as $row) {
										?>
											<option value="<?php echo $row["idDeliveries"]; ?>" <?php echo ($selectedCommande == $row["idDeliveries"]) ? "selected" : ""; ?>><?php echo $row["idDeliveries"]; ?></option>
										<?php }
									} else {
										?>
										<option value="0" disabled hidden selected>No deliveries available</option>
									<?php } ?>
                            </select>
                        </div>
						<?php if (!empty($result)) { ?>
						<form action="../controller/DeleteRequest - Admin.php" method="POST" class="form">
							<input type="text" hidden name="idDelivery" value="<?php echo ($selectedCommande == $row["idDeliveries"]) ? "selected" : ""; ?>">
							<input type="text" hidden name="idUser" value="<?php echo ($selectedType == "DeliveryDriver") ? $row["idLivreur"] : $row["ID"]; ?>">
							<input type="submit" Value='Manage' class="button">
						</form>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
