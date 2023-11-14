<?php
require_once("../Model/config.php");

$bd = new config();
$db = $bd::getConnexion();

$height = isset($_POST['height']) ? $_POST['height'] : null;
$width = isset($_POST['width']) ? $_POST['width'] : null;
$depth = isset($_POST['depth']) ? $_POST['depth'] : null;
$depart = isset($_POST['depart']) ? $_POST['depart'] : null;
$arrivee = isset($_POST['arrivee']) ? $_POST['arrivee'] : null;
$weight = isset($_POST['poids']) ? $_POST['poids'] : null;
$budget = isset($_POST['budget']) ? $_POST['budget'] : null;

// Concatenate height, width, and depth into a string for the size column
$size = $height . " * " . $width . " * " . $depth;

echo "size=$size";

$sql = "INSERT INTO `colis`(`id_client`, `depart`, `arrivee`, `size`, `poids`, `budget`) VALUES (:id_client, :depart, :arrivee, :size, :poids, :budget)";

try {
    $query = $db->prepare($sql);
    $query->execute([
        ':id_client' => 1,
        ':depart' => $depart,
        ':arrivee' => $arrivee,
        ':size' => $size,
        ':poids' => $weight,
        ':budget' => $budget,
    ]);

    // Additional code if needed

    // Redirect to form.php
    //header("Location: ../view/form.php");
    exit();
} catch (PDOException $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

