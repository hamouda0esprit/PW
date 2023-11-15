<?php
require_once("..\Model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = "UPDATE bids SET montant = :montant WHERE idBid = :idBid;";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idBid' => $_POST["idBid"],
        ':montant' => $_POST["currentBid"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/showMO.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
