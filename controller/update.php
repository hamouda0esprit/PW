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
        'idcolis' => $idnouvcolis,
        'depart' => $newDepart,
        'arrivee' => $newArrivee,
        'size' => $newSize,
        'poids' => $newPoids,
        'budget' => $newBudget,
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ../view/showMO.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>