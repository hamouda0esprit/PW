<?php
require_once("..\Model\config.php");

try {
    $db = config::getConnexion();
    $query = $db->prepare(
        'UPDATE colis SET 
            depart = :depart, 
            arrivee = :arrivee, 
            size = :size, 
            poids = :poids, 
            budget = :budget
        WHERE idcolis = :idcolis'
    );
    
    $idnouvcolis = 10; 
    $newDepart = 'tozeur';
    $newArrivee = 'nabeul';
    $newSize = '15*2*9';
    $newPoids = '25';
    $newBudget = '100';

    $query->execute([
        'idcolis' => $idnouvcolis,
        'depart' => $newDepart,
        'arrivee' => $newArrivee,
        'size' => $newSize,
        'poids' => $newPoids,
        'budget' => $newBudget,
    ]);
    
    echo $query->rowCount() . " records UPDATED successfully <br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
