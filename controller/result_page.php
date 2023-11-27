<?php
require_once("..\model\config.php");
$bd = new config();
$pdo = $bd::getConnexion();

$id_client = isset($_GET['id_client']) ? $_GET['id_client'] : '';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteCoupon"])) {
    $couponIdToDelete = $_POST["deleteCoupon"];
    $deleteQuery = $pdo->prepare("DELETE FROM `coupons` WHERE id_coupon = :couponIdToDelete AND id_client = :id_client");
    $deleteQuery->bindParam(':couponIdToDelete', $couponIdToDelete);
    $deleteQuery->bindParam(':id_client', $id_client);
    $deleteQuery->execute();

  
    header("Location: result_page.php?id_client=" . $id_client);
}

$query3 = $pdo->prepare("SELECT * FROM `coupons` WHERE id_client = :id_client");
$query3->bindParam(':id_client', $id_client);
$query3->execute();
$result = $query3->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
    <link rel="stylesheet" type="text/css" href="design_coupon.css">
</head>
<body>
    <div class="historique">
        <table border=1>
            <tr class="firstligne">
                <td>
                    Id_coupon()
                </td>
                <td>
                    Points
                </td>
                <td>
                    Action
                </td>
            </tr>
            <?php
            if (count($result) > 0) {
                foreach ($result as $row) {
            ?>
                    <tr>
                        <td>
                            <?php echo $row["id_coupon"]; ?>
                        </td>
                        <td>
                            <?php echo $row["points"]; ?>
                        </td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="deleteCoupon" value="<?php echo $row["id_coupon"]; ?>">
                                <button type="submit">Use</button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "Pas de Coupon";
            }
            ?>
        </table>
    </div>
</body>
</html>
