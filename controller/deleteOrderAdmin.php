<?php
require_once("..\Model\config.php");

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
    header("Location: ../view/showAMO.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
