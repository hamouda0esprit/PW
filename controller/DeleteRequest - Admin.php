<?php
require_once("..\model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

if ($selectedType == "Client") {
	$query = $pdo->prepare('SELECT * FROM `activedeliveries` WHERE `idDeliveries` = :selectedId');
} elseif ($selectedType == "DeliveryDriver") {
	$query = $pdo->prepare('SELECT * FROM `bids` WHERE `idDeliveries` = :selectedId');
}

$sql = "DELETE FROM `reclamationc` WHERE idReclamationC = :idReclamationC ";
$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
	$query->execute([
		':idReclamationC' => $_POST["idReclamationC"],
   	]);
    

    // Redirect to Ticket Request.php
    header("Location: ../view/Ticket Request.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>