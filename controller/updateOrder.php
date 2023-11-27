<?php
require_once("..\Model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = "UPDATE colis_a_encherer SET montant = :montant , dateDepart = :dateDepart , dateArrive = :dateArrive , comment = :comment WHERE idBid = :idBid;";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idBid' => $_POST["idBid"],
        ':montant' => $_POST["montant"],
        ':dateDepart' => $_POST["dateDepart"],
        ':dateArrive' => $_POST["dateArrive"],
        ':comment' => $_POST["comment"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/showMO.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
