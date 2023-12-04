<?php
require_once("..\..\model\config.php");
$bd = new config();
$pdo = $bd::getConnexion();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["clientId"]) && isset($_POST["stars"]) && isset($_POST["comment"])) {
    $idLivreur =$_POST["idLivreur"];
    $stars = $_POST["stars"];
    $comment = $_POST["comment"];
    // Fetch the selected client ID from the dropdown
    $idClient = $_POST["clientId"];
    $type = $_POST["type"];

    // You can add more validation for stars and comments as needed.

    // Insert the rating into the database
    $insertQuery = $pdo->prepare("INSERT INTO rate (id_client, id_livreur, typee,  stars, comment) VALUES (:idClient, :idLivreur,:typee, :stars, :comment)");
    $insertQuery->bindParam(':idClient', $idClient);
    $insertQuery->bindParam(':typee', $type);
    $insertQuery->bindParam(':idLivreur', $idLivreur);
    $insertQuery->bindParam(':stars', $stars);
    $insertQuery->bindParam(':comment', $comment);

    try {
        $insertQuery->execute();
        // Redirect back to the client's page after the rating
        header("Location: Select.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding rating: " . $e->getMessage();
    }
}
?>
