<?php
require_once("../model/../model/config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$idUser = "1";

$sql = "INSERT INTO `reclamationc`(`idReclamationC`, `idC`, `idL`, `idCommande`, `type`, `description`) VALUES ('',:idC,:idL,:idCommande,:type,:description)";
$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
	if ($idUser[0]=='C'){
		$query->execute([
			':idC' => $idUser,
			':idL' => NULL,
			':idCommande' => $_POST["Commande"],
			':type' => $_POST["type"],
			':description' => $_POST["description"],
    	]);
	}else{
		$query->execute([
			':idC' => NULL,
			':idL' => $idUser,
			':idCommande' => $_POST["Commande"],
			':type' => $_POST["type"],
			':description' => $_POST["description"],
    	]);
	}
    

    // Redirect to Ticket Request.php
    header("Location: ../view/Ticket Request.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>