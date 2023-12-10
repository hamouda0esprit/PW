<?php
function getMyBids($act){
    $avencement = strval(intval($act) - 1)."0";
    require_once("..\..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $bidId = isset($_POST['bid_id']) ? $_POST['bid_id'] : null;

        $query = $pdo->prepare("
            SELECT 
                cae.idcolis,
                cae.idBid,
                cae.montant,
                cae.dateDepart,
                cae.dateArrive,
                cae.comment,
                l.nom AS livreur_nom,
                l.prenom AS livreur_prenom
            FROM 
                colis_a_encherer cae
            JOIN 
                data l ON cae.idLivreur = l.ID
            WHERE 
                cae.status != -1 AND cae.idcolis = :bidId
            LIMIT 10 OFFSET $avencement;
        ");

        $query->bindParam(':bidId', $bidId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();

    } catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){
?>
    <tr>
        <td><p><?php echo $row['livreur_nom'] ." ".$row['livreur_prenom'] ?></p></td>
        <td><p><?php echo $row['idcolis'] ?></p></td>
        <td><p><strong><?php echo $row['montant'] ?> DT</strong></p></td>
        <td><p><?php echo $row['dateDepart'] ?></p></td>
        <td><p><?php echo $row['dateArrive'] ?></p></td>
        <td><p class="cmt"><?php echo $row["comment"] ?></p></td>
        <td>
        <?php
            try{
                $etatstat = $pdo->prepare("SELECT * FROM `colis_a_encherer` WHERE `status` > 0 and `idcolis` = :idc");
                $etatstat->execute([
                    ':idc' => $row['idcolis'],
                ]);

            } catch(PDOExcepion $e){
                echo "connection failed :". $e->getMessage();
            }

            if($etatstat->rowCount() > 0){
                $row2 = $etatstat->fetch(PDO::FETCH_ASSOC);
                ?>
                <form action="followPackage.php" method="POST">
                    <input type="text" id="bid" name="idbid" value="<?php echo $row2['idBid']?>" style="display:none;"/>
                    <button class="btn updateStatus">follow package</button>
                </form>
                <?php
            }else {
        ?>
            <form action="payment\payment.php" method="POST">
                <input type="text" id="bid" name="montant" value="<?php echo $row['montant']?>" style="display:none;"/>
                <input type="text" id="idcolis" name="idcolis" value="<?php echo $row['idcolis']?>" style="display:none;"/>
                <input type="text" id="idBid" name="idBid" value="<?php echo $row['idBid']?>" style="display:none;"/>
                <button class="btn updateStatus" onclick="bidsAction() "><i class="fa-solid fa-check"></i></button>
            </form>
            <form action="..\..\controller\user\mybids\updatebid.php" method="POST">
                <input type="text" id="update" name="idBid" value="<?php echo $row['idBid']?>" style="display:none;"/>
                <button class="btn delete" onclick="modifyDelivery(this)"><i class="fa-solid fa-xmark"></i></button>
            </form>
        </td>
        <?php
        }
        ?>
    </tr>
<?php
    }
}
?>
