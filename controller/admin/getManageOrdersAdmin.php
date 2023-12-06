<?php
function getManageOrdersAdmin(){
    require_once("..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $query = $pdo->prepare("SELECT * FROM `colis_a_encherer`;");


        $query->execute();
        $result = $query->fetchAll();

    }catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){
?>
    <tr>
        <td><p><?php echo $row["idBid"] ?></p></td>
        <td><p><?php echo $row["idcolis"] ?></p></td>
        <td><p><?php echo $row["idLivreur"] ?></p></td>
        <td><p><?php echo $row["montant"] ?></p></td>
        <td><p><?php echo $row["dateDepart"] ?></p></td>
        <td><p><?php echo $row["dateArrive"] ?></p></td>
        <td><p class="cmt"><?php echo $row["comment"] ?></p></td>
        <td>
            <form action="../controller/admin/deleteOrderAdmin.php" method="POST" onsubmit="return confirmdelete()">
                <input type="text" name="idBid" id="idBid"  value="<?php echo $row["idBid"]?>" style="display:none;">
                <input type="submit" value="delete" class="btn delete">
            </form>
        </td>
    </tr>
<?php
    }
}

?>