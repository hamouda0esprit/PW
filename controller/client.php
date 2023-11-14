<?php
require_once("..\Model\config.php");


$bd = new config();
$pdo = $bd::getConnexion();

$sql = "INSERT INTO `colis`(`id_client`, `depart`, `arrivee`, `size`, `poids`) VALUES (:id_client, :depart, :arrivee, :size, :poids,:budget, :budget)";
$db = config::getConnexion();

try {
    $query = $db->prepare($sql);
    $query->execute([
        ':id_client' => 1,
        ':depart' => $_POST["depart"],
        ':arrivee' => $_POST["arrivee"],
        ':size' => $_POST["size"],
        ':poids' => $_POST["poids"],
        ':budget' => $_POST["budget"],
    ]);

    // Additional code if needed

    // Redirect to activeDeliveries.php
    header("Location: ..\view\form.php");
    exit();
} catch (PDOException $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
