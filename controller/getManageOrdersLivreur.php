<?php

function getManageOrdersLivreur(){

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
            l.nom AS nomLivreur
            FROM
                colis_a_encherer cae
            JOIN colis c ON cae.idcolis = c.idcolis
            JOIN user u ON c.id_client = u.ID
            JOIN livreur l ON cae.idLivreur = l.idLivreur
            WHERE cae.idLivreur = 1   
            ");

        $query->execute();
        $result = $query->fetchAll();

    }catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){
?>
    <tr>
        <td><p><?php echo $row["idBid"] ?></p></td>
        <td class="tdUser"><img src="..\Assets\user.png" alt="user"><p><?php echo $row["prenomClient"] . " " . $row["nomClient"] ?></p></td>
        <td><p><?php echo $row["villeDepart"] . " -> " . $row["villeArrivee"] ?></p></td>
        <td><p><?php echo $row["dateDepart"] . " -> " . $row["dateArrive"] ?></p></td>
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
            <form action="../controller/deleteOrder.php" method="POST" onsubmit="return confirmdelete()">
                <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                <input type="submit" value="update" class="btn">
            </form>
            <form action="../controller/deleteOrder.php" method="POST" onsubmit="return confirmdelete()">
                <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                <input type="submit" value="delete" class="btn">
            </form>
        </td>
    </tr>




<?php
    }

}

?>
<script>
    function confirmdelete() {
        x = confirm("are you sure ?");
        if(x == false){
            return false
        }
    }
</script>
<script src="..\controller\getManageOrdersLivreur.js"></script>