<?php
require_once("..\Model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

try {
    // Update the colis table
    $colisQuery = $pdo->prepare('
        UPDATE colis
        SET
            depart = :depart,
            arrivee = :arrivee,
            size = :size,
            poids = :poids,
            budget = :budget
        WHERE idcolis = :idcolis
    ');

    $colisQuery->execute([
        ':idcolis' => $_POST['idcolis'],
        ':depart' => $_POST['depart'],
        ':arrivee' => $_POST['arrivee'],
        ':size' => $_POST['height'] . "*" . $_POST['width'] . "*" . $_POST['depth'],
        ':poids' => $_POST['poids'],
        ':budget' => $_POST['budget'],
    ]);

    // Update the images table
    $imagesQuery = $pdo->prepare('
        UPDATE images
        SET
            nom_image = :nom_image,
            taille_image = :taille_image,
            type_image = :type_image,
            bin_image = :bin_image
        WHERE idcolis = :idcolis
    ');

    // Check if a new image file is uploaded
    if (!empty($_FILES['images']['tmp_name'][0])) {
        $imageName = $_FILES['images']['name'][0];
        $imageSize = $_FILES['images']['size'][0];
        $imageType = $_FILES['images']['type'][0];
        $new_image = file_get_contents($_FILES['images']['tmp_name'][0]);

        $imagesQuery->bindValue(':nom_image', $imageName);
        $imagesQuery->bindValue(':taille_image', $imageSize);
        $imagesQuery->bindValue(':type_image', $imageType);
        $imagesQuery->bindValue(':bin_image', $new_image, PDO::PARAM_LOB);
    } else {
        // If no new image is uploaded, set bin_image to NULL and keep other values
        $imagesQuery->bindValue(':nom_image', NULL, PDO::PARAM_NULL);
        $imagesQuery->bindValue(':taille_image', NULL, PDO::PARAM_NULL);
        $imagesQuery->bindValue(':type_image', NULL, PDO::PARAM_NULL);
        $imagesQuery->bindValue(':bin_image', NULL, PDO::PARAM_NULL);
    }

    $imagesQuery->bindValue(':idcolis', $_POST['idcolis']);
    $imagesQuery->execute();

    // Redirect to mytask.php
    header("Location: ../view/mytask.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
