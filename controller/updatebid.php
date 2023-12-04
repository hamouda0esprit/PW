<?php
require_once("..\Model\config.php");
echo $_POST["idBid"];
$bd = new config();
$pdo = $bd::getConnexion();

$sql = "UPDATE colis_a_encherer SET status = -1 WHERE idBid = :idBid;";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idBid' => $_POST["idBid"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/showbids.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>