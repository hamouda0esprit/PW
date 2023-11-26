<?php
require_once("..\model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

// Fetch the image information before deleting the delivery
try {
    $queryImage = $pdo->prepare('SELECT bin_image FROM images WHERE idcolis = :idcolis');
    $queryImage->execute([
        ':idcolis' => $_POST["delete_id"],
    ]);

    $imageResult = $queryImage->fetch(PDO::FETCH_ASSOC);
    $imageData = $imageResult['bin_image'];

    // Delete the image record
    $sqlDeleteImage = "DELETE FROM images WHERE idcolis= :idcolis;";
    $queryDeleteImage = $pdo->prepare($sqlDeleteImage);
    $queryDeleteImage->execute([
        ':idcolis' => $_POST["delete_id"],
    ]);

    // Continue to delete the delivery
    $sqlDeleteDelivery = "DELETE FROM colis WHERE idcolis= :idcolis;";
    $queryDeleteDelivery = $pdo->prepare($sqlDeleteDelivery);
    $queryDeleteDelivery->execute([
        ':idcolis' => $_POST["delete_id"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/mytask.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
