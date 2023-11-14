<?php
require_once("..\Model\config.php");

$countbox = 0;
$countannim = 0.5;
$bd = new config();
$pdo = $bd::getConnexion();

$sql = "INSERT INTO `bids`(`idBid`, `idLivreur`, `idDeliveries`, `montant`, `dateDepart`, `dateArrive`, `comment`)
        VALUES ('', :idLivreur, :idDeliveries, :montant, :dateDepart, :dateArrive, :comment)";
$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idLivreur' => 1,
        ':idDeliveries' => $_POST["idDeliveries"],
        ':montant' => $_POST["montant"],
        ':dateDepart' => $_POST["dateDepart"],
        ':dateArrive' => $_POST["dateArrive"],
        ':comment' => $_POST["comment"],
    ]);

    // Redirect to activeDeliveries.php
    header(`Location: ..\view\showMO.php`);
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
