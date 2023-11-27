<?php
require_once("config2.php");

$bd = new config();
$pdo = $bd::getConnexion();

$sql = "DELETE FROM users
WHERE user_id IN (
    SELECT DISTINCT users.user_id
    FROM users
    JOIN messages ON users.unique_id = messages.incoming_msg_id
    WHERE messages.msg_id = :msg_id
);

DELETE FROM messages
WHERE incoming_msg_id = :msg_id
   OR outgoing_msg_id = :msg_id
";

$db = config::getConnexion();
try {
    $query = $db->prepare($sql);
    $query->execute([
        ':msg_id' => $_POST["request_id"],
    ]);

    // Redirect to activeDeliveries.php
    header("Location: ..\adminTab.php");
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>