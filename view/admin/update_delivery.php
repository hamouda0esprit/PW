<?php
require_once("..\..\model\config.php");
$bd = new config();
$pdo = $bd::getConnexion();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deliveryId"])) {
    $deliveryId = $_POST["deliveryId"];

    // You can add more variables here for other fields
    $newMontant = isset($_POST["newMontant"]) ? $_POST["newMontant"] : null;
    $newPointsStatus = isset($_POST["newPointsStatus"]) ? $_POST["newPointsStatus"] : null;

    // Construct the SET clause dynamically based on the provided fields
    $setClause = '';
    $updateData = array();

    if (!is_null($newMontant)) {
        $setClause .= 'montant = :newMontant, ';
        $updateData[':newMontant'] = $newMontant;
    }

    if (!is_null($newPointsStatus)) {
        $setClause .= 'points_status = :newPointsStatus, ';
        $updateData[':newPointsStatus'] = $newPointsStatus;
    }

    // Remove the trailing comma and space from the SET clause
    $setClause = rtrim($setClause, ', ');

    // Update the delivery information in the database
    $updateQuery = $pdo->prepare("UPDATE bids SET {$setClause} WHERE idDeliveries = :deliveryId");

    foreach ($updateData as $param => &$value) {
        $updateQuery->bindParam($param, $value);
    }

    $updateQuery->bindParam(':deliveryId', $deliveryId);

    try {
        $updateQuery->execute();
        // Redirect back to the admin page after the update
        header("Location: Main_page_admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating delivery: " . $e->getMessage();
    }
}
?>
