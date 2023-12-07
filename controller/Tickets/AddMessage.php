<?php
require_once("../../model/Tickets/config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$idUser = "1";

$sql = "INSERT INTO `reclamationa`(`idReclamationA`, `idP`, `message`, `date`) VALUES (:idReclamationA, :idP, :message, :date)";
$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idReclamationA' => $_POST["idRec"],
        ':idP' => $idUser,
        ':message' => $_POST["message"],
        ':date' => $_POST["Date"],
    ]);
    

    // Redirect to Ticket Request.php
    header("Location: ../../view/Tickets/Ticket.php");
    exit();
}catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>