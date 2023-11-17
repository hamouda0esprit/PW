<?php
require_once("..\Model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = 'UPDATE colis SET 
depart = :depart, 
arrivee = :arrivee, 
size = :size, 
poids = :poids, 
budget = :budget
WHERE idcolis = :idcolis';

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':idcolis' => $_POST['idcolis'],
        ':depart' => $_POST['depart'],
        ':arrivee' => $_POST['arrivee'],
        ':size' => $_POST['size'],
        ':poids' => $_POST['poids'],
        ':budget' => $_POST['budget'],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/mytask.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>