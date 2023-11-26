<?php
require_once("..\Model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = 'UPDATE colis c
        LEFT JOIN images i ON c.idcolis = i.idcolis
        SET 
        c.depart = :depart, 
        c.arrivee = :arrivee, 
        c.size = :size, 
        c.poids = :poids, 
        c.budget = :budget';

// Check if a new image file is uploaded
if (!empty($_FILES['pictures']['tmp_name'])) {
    // Handle the new image
    $new_image = file_get_contents($_FILES['pictures']['tmp_name']);
    $sql .= ', i.bin_image = :bin_image';
}

$sql .= ' WHERE c.idcolis = :idcolis';

try {
    $query = $pdo->prepare($sql);

    // Bind values
    $query->bindValue(':idcolis', $_POST['idcolis']);
    $query->bindValue(':depart', $_POST['depart']);
    $query->bindValue(':arrivee', $_POST['arrivee']);
    $query->bindValue(':size', $_POST['height'] . "*" . $_POST['width'] . "*" . $_POST['depth']);
    $query->bindValue(':poids', $_POST['poids']);
    $query->bindValue(':budget', $_POST['budget']);

    // Bind image data if a new image is uploaded
    if (!empty($_FILES['pictures']['tmp_name'])) {
        $query->bindValue(':bin_image', $new_image, PDO::PARAM_LOB);
    }

    // Execute the query
    $query->execute();

    // Redirect to mytask.php
    header("Location: ../view/mytask.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
