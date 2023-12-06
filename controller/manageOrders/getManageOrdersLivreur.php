<?php

function getManageOrdersLivreur($act){
    $avencement = strval(intval($act) - 1)."0";
    require_once("..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $query = $pdo->prepare("
    SELECT
        cae.idBid,
        u.nom AS nomClient,
        u.prenom AS prenomClient,
        c.idcolis,
        cae.dateDepart,
        cae.dateArrive,
        cae.status,
        c.depart AS villeDepart,
        c.arrivee AS villeArrivee,
        cae.montant,
        cae.comment,
        l.nom AS nomLivreur
    FROM
        colis_a_encherer cae
    JOIN 
        colis c ON cae.idcolis = c.idcolis
    JOIN 
        user u ON c.id_client = u.ID
    JOIN 
        livreur l ON cae.idLivreur = l.idLivreur
    WHERE 
        cae.idLivreur = 1
    LIMIT 10 OFFSET $avencement;
");


        $query->execute();
        $result = $query->fetchAll();

    }catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){
?>
    <tr>
        <td class="tdId"><p>&nbsp;&nbsp;&nbsp;<?php echo $row["idBid"] ?>&nbsp;&nbsp;&nbsp;</p></td>
        <td class="tdUser"><img src="..\Assets\user.png" alt="user"><p><?php echo $row["prenomClient"] . " " . $row["nomClient"] ?></p></td>
        <td><p><?php echo $row["villeDepart"] ?></p></td>
        <td><p><?php echo $row["villeArrivee"] ?></p></td>
        <td><p><?php echo $row["dateDepart"] ?></p></td>
        <td><p><?php echo $row["dateArrive"] ?></p></td>
        <td><p><strong><?php echo $row["montant"] ?> DT</strong></p></td>
        <td><?php   
                if( intval($row["status"]) == -1 ){
                    echo "<p class='status cancelled'> Cancelled </p>";
                }else if(intval($row["status"]) == 0){
                    echo "<p class='status pending'> Pending </p>";
                }else if(intval($row["status"]) == 1){
                    echo "<p class='status accepted'> Accepted </p>";
                }else if(intval($row["status"]) == 2){
                    echo "<p class='status collected'> Collected </p>";
                }else if(intval($row["status"]) == 3){
                    echo "<p class='status dellivered'> Dellivered </p>";
                }
            ?></td>
        <td>
        
            <button class="btn update"onclick="hideBid(<?php echo $countbox;?>)" <?php if(intval($row["status"]) != 0){echo "disabled";}?>>update</button>

            <form action="../controller/manageOrders/deleteOrder.php" method="POST" onsubmit="return confirmdelete()">
                <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>" style="display:none;">
                <input type="submit" value="delete" class="btn delete" <?php if(intval($row["status"]) == 1 || intval($row["status"]) == 2){echo "disabled";}?>>
            </form>

            <form action="./ShowUpdateStatus.php" method="POST" onsubmit="return confirmdelete()">
                <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>" style="display:none;">
                <input type="submit" value="upade status" class="btn updateStatus" <?php if(intval($row["status"]) == 0 || intval($row["status"]) == -1){echo "disabled";}?>>
            </form>
        </td>
    </tr>
    <div class="bidForm hide">
        <div>
            <div class="closeDiv"><button onclick="hideBid(<?php 
                echo $countbox;
                $countbox++;
            
            ?>)">x</button></div>
            <h3 class="bidTitle">bid form</h3>
            <form action="../controller/manageOrders/updateOrder.php" method="POST" onsubmit="return control(<?php echo ($countbox-1);?>)">        
                <input type="number" class="normal" name="idBid" id="idDeliveries" value="<?php echo $row["idBid"]?>">
                <input type="text" class="normal" name="montant" id="bid" placeholder="bid" value="<?php echo $row["montant"]?>">
                <div id="dateHolder">
                    <input type="date" class="normal" name="dateDepart" id="dateDepart" placeholder="Date Depart" value="<?php echo $row["dateDepart"]?>">
                    <input type="date" class="normal" name="dateArrive" id="dateArrive" placeholder="Date Arrive" value="<?php echo $row["dateArrive"]?>">
                </div>
                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="comment"><?php echo $row["comment"]?></textarea>
                <input type="submit" value="BID" id="sendBid">
            </form>
        </div>
    </div>



<?php
    }
}
?>
