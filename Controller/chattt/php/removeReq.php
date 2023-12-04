<?php
require_once("config2.php");

$bd = new config();
$pdo = $bd::getConnexion();

// Start a transaction
$pdo->beginTransaction();

try {
    // Insert a row into report_status
    $insertReportStatusSql = "INSERT INTO `report_status` (`reason`, `id_user`) VALUES (:reason, :id_user)";
    $insertReportStatusQuery = $pdo->prepare($insertReportStatusSql);
    $insertReportStatusQuery->execute([
        ':reason' => $_POST["reason"], // Replace with your actual reason
        ':id_user' => 4, // Replace with the actual user ID
    ]);

    // Remove from the report table
    $removeReportSql = "DELETE FROM `report` WHERE `report_id` = :report_id;";
    $removeReportQuery = $pdo->prepare($removeReportSql);
    $removeReportQuery->execute([
        ':report_id' => $_POST["request_id"],
    ]);

    // Commit the transaction
    $pdo->commit();

    // Redirect to adminTab.php
    header("Location: ../adminTab.php");
    exit();
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $pdo->rollBack();

    echo 'Error: ' . $e->getMessage();
}
?>
