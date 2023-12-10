<?php

require_once("..\..\..\Model\config.php");

$bd = new config();
$pdo = $bd::getConnexion();

try {
    $query = $pdo->prepare(
        "SELECT * FROM cards WHERE card_number = :number and card_holder_name = :name and exp_date = :exp and ccv = :ccv;"
    );

    $query->execute([
        ':number' => intval(str_replace(' ', '', $_POST["number"])),
        ':name' => $_POST["name"],
        ':exp' => $_POST["exdate"],
        ':ccv' => $_POST["sec"],
    ]);

    if ($query->rowCount() > 0) {
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row["balance"] >= $_POST["montant"]) {
            try {
                $updateCard = $pdo->prepare('
                    UPDATE `cards` SET `balance`= :balance WHERE `card_number` = :card_number
                ');
                $newsolde =  strval( floatval($row["balance"]) - floatval($_POST["montant"]));
                echo $newsolde."  ".$row["balance"]." ".$_POST["montant"];
                $updateCard->execute([
                    ':balance' => $newsolde,
                    ':card_number' => intval(str_replace(' ', '', $_POST["number"])),
                ]);
            } catch (PDOException $e) {
                // Handle the exception
                echo "Update card failed: " . $e->getMessage();
            }

            try {
                $updateAcc = $pdo->prepare('
                    UPDATE `colis_a_encherer` SET `status`= 1 WHERE `idBid` = :idBid
                ');

                $updateAcc->execute([
                    ':idBid' => $_POST["idBid"],
                ]);

                // Add exit() here if needed
            } catch (PDOException $e) {
                // Handle the exception
                echo "Update colis_a_encherer failed: " . $e->getMessage();
            }

            try {
                $updateOtherAcc = $pdo->prepare('
                    UPDATE `colis_a_encherer` SET `status`= -1 WHERE `idBid` != :idBid and `idcolis` = :idcolis
                ');

                $updateOtherAcc->execute([
                    ':idBid' => $_POST["idBid"],
                    ':idcolis' => $_POST["idcolis"],
                ]);

                // Add exit() here if needed
            } catch (PDOException $e) {
                // Handle the exception
                echo "Update other colis_a_encherer failed: " . $e->getMessage();
            }
            header("Location: ../../../view/user/showMyTask.php");
            exit();
        } else {
            header("Location: ../../../view/user/payment/noBalance.php");
            exit();
        }
    } else {
        header("Location: ../../../view/user/payment/notAccepted.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
