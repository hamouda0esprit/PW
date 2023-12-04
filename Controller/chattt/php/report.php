<?php
require_once("config2.php");

$bd = new config();
$pdo = $bd::getConnexion();
$sql = "INSERT INTO report(msg_id,userid) VALUES (:msg_id,:userid)";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':msg_id' => $_POST["idReport"],
        ':userid' => $_POST["userid"]
    ]);
    // Redirect to activeDeliveries.php
    header("Location: ../login.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>