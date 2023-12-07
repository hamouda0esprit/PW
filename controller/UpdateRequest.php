<?php
require_once("..\model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$idUser = "1";

$sql = "UPDATE `reclamationc` SET `Status`='1' WHERE idReclamationC = :idReclamationC ";
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