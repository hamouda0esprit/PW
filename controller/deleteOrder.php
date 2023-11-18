<?php
require_once("..\Model\config.php");

$countbox = 0;
$countannim = 0.5;
$bd = new config();
$pdo = $bd::getConnexion();

$sql = "DELETE FROM `bids` WHERE idBid = :idBid;";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idBid' => $_POST["idBid"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/showMO.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>