<?php
require_once("..\..\..\Model\config.php");

$countbox = 0;
$countannim = 0.5;
$bd = new config();
$pdo = $bd::getConnexion();

$sql = "INSERT INTO `colis_a_encherer`(`idBid`, `idLivreur`, `idcolis`, `montant`, `dateDepart`, `dateArrive`, `comment`,`status`)
        VALUES ('', :idLivreur, :idDeliveries, :montant, :dateDepart, :dateArrive, :comment,0)";
$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idLivreur' => 'L1',
        ':idDeliveries' => $_POST["idDeliveries"],
        ':montant' => $_POST["montant"],
        ':dateDepart' => $_POST["dateDepart"],
        ':dateArrive' => $_POST["dateArrive"],
        ':comment' => $_POST["comment"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../../../view/livreur/showMO.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
