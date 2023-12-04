<!DOCTYPE html>
<html>
<head>
    <title>Delivelink Points</title>
    <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
    <?php
        require_once("..\..\model\config.php");
        $bd = new config();
        $pdo = $bd::getConnexion();
    ?>
    <h1>Your DeliverLink Points</h1>
    <div class ="historique">
        <table border = 1>
            <tr class = "firstligne">
                <td>
                    Id - Livraison
                </td>
                <td class="montant">
                    Montant
                </td>
                <td>
                    Points(10% Du montant)
                </td>
                <td>
                    Status
                </td>
                <td>
                    Date d'arrivee
                </td>
                <td>
                    Date d'envoie
                </td>
                <td>
                    Modify Delivery
                </td>
            </tr>
            <?php 
                if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["clientId"])){
                    $id_client = $_GET["clientId"];
                    $query = $pdo->prepare("SELECT * FROM `bids` WHERE idLivreur = :id_client");
                    $query->bindParam(':id_client', $id_client);
                    $query->execute();
                    $result = $query->fetchAll();
                    $allpoints = 0;
                    $somme=0;
                    $status = 0;

                    if (count($result) > 0) {
                        foreach ($result as $row) { 
            ?>
                            <tr <?php echo ($row["points_status"] == 1) ? 'class="status-1"' : ''; ?>>
                                <td>
                                    <?php echo $row["idDeliveries"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["montant"]; ?>
                                </td>
                                <td>
                                    <?php 
                                        $status= $row["points_status"];
                                        $prix= $row["montant"];
                                        $allpoints = $allpoints + (int)($prix/10);
                                        if($status == 0){
                                            $somme = $somme + (int)($prix/10);
                                        }
                                        echo (int)($prix/10);
                                    ?>
                                </td>
                                <td>
                                    <?php echo $status; ?>
                                </td>
                                <td>
                                    <?php echo $row["dateDepart"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["dateArrive"]; ?>
                                </td>
                                <td>
                                    <!-- Form for modifying delivery information -->
                                    <form action="update_delivery.php" method="post">
                                        <input type="hidden" name="deliveryId" value="<?php echo $row["idDeliveries"]; ?>">
                                        
                                        <label for="newMontant">New Montant:</label>
                                        <input type="text" name="newMontant" required>

                                        <label for="newPointsStatus">New Points Status:</label>
                                        <input type="text" name="newPointsStatus" required>

                                        <button type="submit">Update Delivery</button>
                                    </form>
                                </td>
                            </tr>
            <?php 
                        }
                    } else {
                        echo "Pas de livraison";
                    }
                    $query = $pdo->prepare("UPDATE delivery_point SET Points = :Points WHERE id_client = :id_client");
                    $query->bindParam(':Points', $allpoints);
                    $query->bindParam(':id_client', $id_client);
                    try {
                        $query->execute();
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            ?>
            sele
        </table>
        <hr class = "hr">
    </div>
    <script src ="verification.js"></script>
</body>
</html>
