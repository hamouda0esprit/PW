<?php
require_once("config2.php");
session_start();
$bd = new config();
$pdo = $bd::getConnexion();
$action = $_POST["action"];
if ($action == "ban") {
    $sql = "UPDATE users SET banned = 1 WHERE user_id = :id";
    $db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':id' => $_POST['id'],
    ]);
    header("Location: ../adminTab.php");
    exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    $insertReportStatusSql = "INSERT INTO `report_status` (`reason`, `id_user`) VALUES (:reason, :id_user)";
    $insertReportStatusQuery = $pdo->prepare($insertReportStatusSql);
    $insertReportStatusQuery->execute([
        ':reason' => $_POST["reason"], // Replace with your actual reason
        ':id_user' => 4, // Replace with the actual user ID
        
    ]);
    $removeReportSql = "DELETE FROM `report` WHERE `report_id` = :report_id;";
    $removeReportQuery = $pdo->prepare($removeReportSql);
    $removeReportQuery->execute([
        ':report_id' => $_POST["request_id"],
    ]);
    header("Location: ../adminTab.php");
    exit();
    // Commit the transaction
    // Redirect to adminTab.php
   
}
?>