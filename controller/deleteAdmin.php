<?php
require_once("..\model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = "DELETE FROM `colis` WHERE idcolis= :idcolis;";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idcolis' => $_POST["delete_id"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/adminview.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>