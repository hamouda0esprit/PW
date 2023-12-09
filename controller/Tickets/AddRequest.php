<?php
require_once("../../model/Tickets/config.php");

$bd = new config();
$pdo = $bd::getConnexion();


$sql = "INSERT INTO `reclamationc`(`idReclamationC`, `idP`, `idCommande`, `type`, `description`) VALUES ('',:idP,:idCommande,:type,:description)";
$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
	$query->execute([
		':idP' => $_POST["idP"],
		':idCommande' => $_POST["Commande"],
		':type' => $_POST["type"],
		':description' => $_POST["description"],
    ]);
    

    // Redirect to Ticket Request.php
    header("Location: ../../view/Tickets/Ticket Request.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>