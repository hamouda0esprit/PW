<?php
require_once("config2.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = "DELETE FROM `report` WHERE `report_id` = :msg_id;";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':msg_id' => $_POST["request_id"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ..\adminTab.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>