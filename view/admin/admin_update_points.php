<?php
require_once("..\..\model\config.php");
$bd = new config();
$pdo = $bd::getConnexion();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["clientId"]) && isset($_POST["newPoints"])) {
    $clientId = $_POST["clientId"];
    $newPoints = $_POST["newPoints"];

    // Update the points in the database
    $updateQuery = $pdo->prepare("UPDATE delivery_point SET Points = :newPoints WHERE id_client = :clientId");
    $updateQuery->bindParam(':newPoints', $newPoints);
    $updateQuery->bindParam(':clientId', $clientId);

    try {
        $updateQuery->execute();
        // Fetch and display updated client information
        include 'admin_update_client.php';
    } catch (PDOException $e) {
        echo "Error updating points: " . $e->getMessage();
    }
}
?>
