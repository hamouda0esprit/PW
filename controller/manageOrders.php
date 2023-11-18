<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../manageOrders.css">
</head>
<body>
    <?php
    function showManageOrders(){
        $index = 0;
    ?>
    <center>
    <table id="tableOrders">
        <tr id="thLine">
            <th>Task</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Bid</th>
            <th>Delete</th>
        </tr>
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
        <tr class="<?php
         if($index%2 == 0){
            echo "bwhite";
         }else{
            echo "bgrey";
         }
         $index++;
        ?>">
            <td><?php echo "#" . $row["idBid"] ?></td>
            <td><?php echo $row["dateDepart"] . " -> " . $row["dateArrive"] ?></td>
            <td>
                not assigned yet
            </td>
            <td>
                <form action="../controller/updateOrder.php" method="POST">
                    <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                    <input type="text" name="currentBid" id="currentBid" value="<?php echo $row["montant"]?>" class="inpt"> 
                    <input type="submit" value="update" class="btn">
                </form>
            </td>
            <td>
                <form action="../controller/deleteOrder.php" method="POST" onsubmit="return confirmdelete()">
                    <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                    <input type="submit" value="delete" class="btn">
                </form>
            </td>
        </tr>
        <?php
    }   
    ?>
    </table>
    </center>
    <center>
        <div class="smallScreenManageOrders">
            <?php 
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
            <div class="content <?php
         if($index%2 == 0){
            echo "bwhite";
         }else{
            echo "bgrey";
         }
         $index++;
        ?>">
                <div><h3>Task : </h3><p>&nbsp; <?php echo $row["idBid"] ?> </p></div>
                <div><h3>Delivery Date : </h3><p>&nbsp;<?php echo $row["dateDepart"] . " -> " . $row["dateArrive"] ?> </p></div>
                <div><h3>Status : </h3><p>&nbsp;not assigned yet</p></div>
                <div>
                    <h3>Bid : </h3>
                    <form action="../controller/updateOrder.php" method="POST">
                        <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                        <input type="text" name="currentBid" id="currentBid" value="<?php echo $row["montant"]?>" class="inpt">
                        <input type="submit" value="update" class="btn">
                    </form>
                </div>
                <div>
                    <h3>Delete :</h3> 
                    <form action="../controller/deleteOrder.php" method="POST" onsubmit="return confirmdelete()">
                        <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                        <input type="submit" value="delete" class="btn">
                    </form>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    <?php
    }   
    ?>
    </center>
    <script>
        function confirmdelete() {
            x = confirm("are you sure ?");
            if(x == false){
                return false
            }
        }
    </script>
</body>
</html>