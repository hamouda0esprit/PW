<?php
require_once("..\model\config.php");
$bd = new config();
$pdo = $bd::getConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_client = $_POST["clientId"];
    $status = 1;
    $Points = 0;

    $query2 = $pdo->prepare("SELECT * FROM `bids` WHERE idLivreur = :id_client");
    $query2->bindParam(':id_client', $id_client);
    $query2->execute();
    $result = $query2->fetchAll();

    foreach ($result as $row) {
        if ($row['points_status'] == 0) {
            $Points += ($row['montant']) / 10;
        }
    }

    $query = $pdo->prepare("UPDATE bids SET points_status = :points_status WHERE idLivreur = :id_client");
    $query->bindParam(':points_status', $status);
    $query->bindParam(':id_client', $id_client);
    $query->execute();

    // Check if there are existing coupons
    $checkExistingCoupons = $pdo->prepare("SELECT COUNT(*) AS coupon_count FROM coupons WHERE id_client = :id_client");
    $checkExistingCoupons->bindParam(':id_client', $id_client);
    $checkExistingCoupons->execute();
    $couponCountResult = $checkExistingCoupons->fetch(PDO::FETCH_ASSOC);

    if ($couponCountResult['coupon_count'] > 0) {
        // If there are existing coupons, get the maximum id_coupon and increment
        $checkMaxCoupon = $pdo->prepare("SELECT MAX(id_coupon) AS max_coupon FROM coupons WHERE id_client = :id_client");
        $checkMaxCoupon->bindParam(':id_client', $id_client);
        $checkMaxCoupon->execute();
        $maxCouponResult = $checkMaxCoupon->fetch(PDO::FETCH_ASSOC);

        $couponId = (int)$maxCouponResult['max_coupon'] + 1;
    } else {
        // If no coupons exist, set id_coupon to 0
        $couponId = 1;
    }

    $sql = "INSERT INTO coupons (id_coupon, id_client, points) VALUES (:id_coupon, :id_client, :points)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_coupon', $couponId);
    $stmt->bindParam(':id_client', $id_client);
    $stmt->bindParam(':points', $Points);
    $stmt->execute();

    // Redirect to prevent form resubmission on page refresh
    header("Location: result_page.php?id_client=" . $id_client);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            </tr>
            <?php
            $id_client = isset($_GET['id_client']) ? $_GET['id_client'] : '';
            $query3 = $pdo->prepare("SELECT * FROM `coupons` WHERE id_client = :id_client");
            $query3->bindParam(':id_client', $id_client);
            $query3->execute();
            $result = $query3->fetchAll();
            if (count($result) > 0) {
                foreach ($result as $row) {
            ?>
                    <tr>
                        <td>
                            <?php
                            echo $row["id_coupon"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row["points"];
                            ?>
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
