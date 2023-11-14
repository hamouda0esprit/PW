<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../manageOrders.css">
</head>
<body>
    <h2>Manage Orders</h2>
    <?php
    function showManageOrders(){
    ?>
    <center>
    <table id="tableOrders">
        <tr id="thLine">
            <th>Task</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Bid</th>
            <th></th>
        </tr>
        <!-- <tr>
            <td>test</td>
            <td>test</td>
            <td>
                <select name="starus" id="starus">
                    <option value="-1">not taken</option>
                    <option value="0">on the way</option>
                    <option value="1">delivered</option>
                </select>
            </td>
            <td>test</td>
            <td>test</td>
        </tr> -->
        <?php
        require_once("..\model\config.php"); 
        $countbox = 0;
        $countannim = 0.5;
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            $query = $pdo->prepare(
                'SELECT * FROM `bids` WHERE idLivreur = 1;'
            );

            $query->execute();
            $result = $query->fetchAll();

        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){


        ?>
        <tr>
            <td><?php echo "#" . $row["idBid"] ?></td>
            <td><?php echo $row["dateDepart"] . " - " . $row["dateArrive"] ?></td>
            <td>
                
            </td>
            <td>
                <form action="../controller/updateOrder.php" method="POST">
                    <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                    <input type="text" name="currentBid" id="currentBid" value="<?php echo $row["montant"]?>"> 
                    <input type="submit" value="update">
                </form>
            </td>
            <td>
                <form action="../controller/deleteOrder.php" method="POST">
                    <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                    <input type="submit" value="delete">
                </form>
            </td>
        </tr>
        <?php
    }   
    ?>
    </table>
    </center>

    <?php
    }   
    ?>
</body>
</html>