<?php
require_once("config2.php");
$bd = new config();
$pdo = $bd::getConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && isset($_POST["request_id"]) && isset($_POST["reason"]) && isset($_POST["report_id"])) {
        $action = $_POST["action"];
        $requestId = $_POST["request_id"];
        $reason = $_POST["reason"];
        $reportId = $_POST["report_id"];

        if ($action == "ban") {
            try {
                // Update report_status table
                $insertQuery = $pdo->prepare('INSERT INTO report_status (id_report, `reason ban`, Banned) VALUES (?, ?, 1)');
                $insertQuery->execute([$reportId, $reason]);

                // Remove from the report table
                $deleteQuery = $pdo->prepare('DELETE FROM report WHERE report_id = ?');
                $deleteQuery->execute([$reportId]);

                // Redirect to the original page to avoid form resubmission on page refresh
                header("Location: your_original_page.php");
                exit();
            } catch (PDOException $e) {
                echo "Error executing query: " . $e->getMessage();
            }
        } elseif ($action == "remove") {
            try {
                // Remove from the report table
                $deleteQuery = $pdo->prepare('DELETE FROM report WHERE report_id = ?');
                $deleteQuery->execute([$reportId]);

                // Redirect to the original page to avoid form resubmission on page refresh
                header("Location: your_original_page.php");
                exit();
            } catch (PDOException $e) {
                echo "Error executing query: " . $e->getMessage();
            }
        }
    }
} else {
    // Redirect to the original page if accessed directly
    header("Location: your_original_page.php");
    exit();
}
?>
