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

    // Get the ID of the last inserted colis
    $lastInsertedColisId = $db->lastInsertId();

    // Handle image uploads
    $imageErrors = [];
    $imageUploadPath = "../uploads/"; // Set the path where you want to store the images

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $imageName = $_FILES['images']['name'][$key];
        $imageSize = $_FILES['images']['size'][$key];
        $imageType = $_FILES['images']['type'][$key];
        $imageError = $_FILES['images']['error'][$key];

        if ($imageError == 0) {
            $imageContent = file_get_contents($tmp_name);

            // Insert the image into the 'images' table
            $imageSql = "INSERT INTO `images`(`idcolis`, `nom_image`, `taille_image`, `type_image`, `bin_image`) VALUES (:idcolis, :nom_image, :taille_image, :type_image, :bin_image)";
            
            $imageQuery = $db->prepare($imageSql);
            $imageQuery->execute([
                ':idcolis' => $lastInsertedColisId,
                ':nom_image' => $imageName,
                ':taille_image' => $imageSize,
                ':type_image' => $imageType,
                ':bin_image' => $imageContent,
            ]);

            // Handle additional code if needed
        } else {
            $imageErrors[] = "Error uploading image '$imageName'";
        }
    }

    // Additional code if needed

    // Redirect to form.php
    header("Location: ../view/form.php");
    exit();
} catch (PDOException $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
