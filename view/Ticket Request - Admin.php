<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

        // Initialize variables
        $selectedType = "0";
        $selectedUser = "0";
		$selectedCommande = "0";

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Update selectedType
            if (isset($_POST["type"])) {
                $selectedType = $_POST["type"];
            }

            // Update selectedUser
            if (isset($_POST["User"])) {
                $selectedUser = $_POST["User"];
            }
			
			// Update selectedCommande
            if (isset($_POST["Commande"])) {
                $selectedCommande = $_POST["Commande"];
            }
        }
    ?>

    <!--select type-->
    <div class="main_container">
        <div class="Top">
            <h1 class="title">Create Ticket</h1>
        </div>
		
		
        <div class="Middle">
			<form action="../view/Ticket Request - Admin.php" method="POST" class="cf">
				<div class="type">
					<div class="box">
						<div class="content">
							<h3 class="title"><i class="fa-solid fa-bullseye"></i> Type</h3>
							<div class="select-box">
                                <select name="type" id="type" class="select" onchange="saveSelection('type'); this.form.submit();">
                                    <option value="0" disabled hidden selected>Please choose a type</option>
                                    <option value="Client">Client</option>
                                    <option value="DeliveryDriver">Livreur</option>
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
                                <select name="User" id="User" class="select" onchange="saveSelection('User'); this.form.submit();">
                                    <option value="0" disabled hidden selected>Please choose a delivery</option>
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
                                        <option value="<?php echo ($selectedType == "DeliveryDriver") ? $row["idLivreur"] : $row["ID"]; ?>"><?php echo $row["prenom"] ?> <?php echo $row["nom"] ?></option>
                                    <?php } ?>
                                </select>
							</div>
						</div>
					</div>
				</div>
			</form>
        </div>
		

        <div class="Bottom">
            <div class="Commande">
                <div class="box">
                    <div class="content">
                        <h3 class="title"><i class="fa-solid fa-bullseye"></i> Commande</h3>
                        <div class="select-box">
                            <form action="../view/Ticket Request - Admin.php" method="POST" class="cf">
                                <select name="Commande" id="commande" class="select" onchange="saveSelection('Commande'); this.form.submit();">
                                    <option value="0" disabled hidden selected>Please choose a delivery</option>
                                    <?php
                                    try {
                                        if ($selectedType == "Client") {
                                            $query = $pdo->prepare('SELECT * FROM `activedeliveries` WHERE `ID` = :selectedUser');
                                        } else {
                                            $query = $pdo->prepare('SELECT * FROM `bids` WHERE `idLivreur` = :selectedUser');
                                        }

                                        $query->bindParam(':selectedUser', $selectedUser);

                                        // Execute the query
                                        $query->execute();
                                        $result = $query->fetchAll();
                                    } catch (PDOException $e) {
                                        echo "Connection failed: " . $e->getMessage();
                                    }
                                    if (!empty($result)) {
                                        foreach ($result as $row) {
                                            ?>
                                            <option value="<?php echo $row["idDeliveries"]; ?>"><?php echo $row["idDeliveries"]; ?></option>
                                            <?php }
                                        } else {
                                            ?>
                                            <option value="0" disabled hidden selected>No deliveries available</option>
                                        <?php } ?>
                                </select>
                            </form>
                        </div>
                        <?php if (!empty($result)) { ?>
                        <form action="../view/Ticket Manage - Admin.php" method="POST" class="form" onSubmit="getvalue();">
							<input type="text" hidden name="selectedType" value="<?php echo $selectedType; ?>">
                            <input type="text" hidden name="idDelivery" id="idDelivery" value="<?php echo $selectedCommande; ?>">
                            <input type="text" hidden name="idUser" value="<?php echo ($selectedType == "DeliveryDriver") ? $selectedUser : ""; ?>">
                            <input type="submit" value="Manage" class="button">
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
