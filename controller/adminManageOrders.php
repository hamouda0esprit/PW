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
    function showAdminManageOrders(){
        $index = 0;
        $filterC = "";
        $filterL = "";
        $sqlSelectLine = "";
        if (isset($_POST["selectClient"])) {
            $filterC = $_POST["selectClient"];
        }else{
            $filterC = "-1";
        }

        
        if(isset($_POST["selectLivreur"])){
            $filterL = $_POST["selectLivreur"];
        }else{
            $filterL = "-1";
        }
        
        // changing sql line for filter
        if($filterC == "-1" && $filterL == "-1"){
            $sqlSelectLine = 'SELECT * FROM `bids`;';
        }else if($filterL == "-1"){
            $sqlSelectLine = 'SELECT bids.*
            FROM bids
            JOIN activedeliveries ON bids.idDeliveries = activedeliveries.idDeliveries
            JOIN user ON activedeliveries.ID = user.ID
            WHERE user.ID ='.$filterC;
        }else if($filterC == "-1"){
            $sqlSelectLine = 'SELECT bids.*
            FROM bids
            JOIN livreur ON bids.idLivreur = livreur.idLivreur
            WHERE livreur.idLivreur ='.$filterL;
        }else{
            $sqlSelectLine = 'SELECT bids.*
            FROM bids
            JOIN activedeliveries ON bids.idDeliveries = activedeliveries.idDeliveries
            JOIN user ON activedeliveries.ID = user.ID
            JOIN livreur ON bids.idLivreur = livreur.idLivreur
            WHERE user.ID = '.$filterC.' AND livreur.idLivreur = '.$filterL;
        }
?>
    <div class="formFilter">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <select name="selectClient" id="selectClient">
                <option value="-2" selected disabled hidden>sort by client</option>
                <option value="-1">all</option>
                <?php 
                    require_once("..\model\config.php"); 
                    $bd = new config();
                    $pdo = $bd::getConnexion();
                    try{
                        $query = $pdo->prepare(
                            'SELECT * FROM `user`;'
                        );
            
                        $query->execute();
                        $result = $query->fetchAll();
            
                    }catch(PDOExcepion $e){
                        echo "connection failed :". $e->getMessage();
                    }
                    foreach($result as $row){
                ?>
                    <option value="<?php echo $row['ID'] ?>"><?php echo $row['nom']." ".$row['prenom'] ?></option>
                <?php
                    }
                ?>
            </select>
            <select name="selectLivreur" id="selectLivreur">
                <option value="-2" selected disabled hidden>sort by delivery driver</option>
                <option value="-1">all</option>
                <?php 
                    require_once("..\model\config.php"); 
                    $bd = new config();
                    $pdo = $bd::getConnexion();
                    try{
                        $query = $pdo->prepare(
                            'SELECT * FROM `livreur`;'
                        );
            
                        $query->execute();
                        $result = $query->fetchAll();
            
                    }catch(PDOExcepion $e){
                        echo "connection failed :". $e->getMessage();
                    }
                    foreach($result as $row){
                ?>
                    <option value="<?php echo $row['idLivreur'] ?>"><?php echo $row['nom']." ".$row['prenom'] ?></option>
                <?php
                    }
                ?>
            </select>
            <input type="submit" value="CLEAR">
            <input type="submit" value="SORT">
        </form>
    </div>
    <center>
     <table id="tableOrders">
        <tr id="thLine">
            <th>idBid</th>
            <th>idDelivery</th>
            <th>iDdeliveryDriver</th>
            <th>Bid</th>
            <th>Actions</th>
        </tr>
    
    <?php
        require_once("..\model\config.php"); 
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            $query = $pdo->prepare($sqlSelectLine);

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
            <td><?php echo "#" . $row["idLivreur"] ?></td>
            <td><?php echo "#" . $row["idDeliveries"] ?></td>
            <td><?php echo " " . $row["montant"] ?></td>
            <td class="tdAction">
                <form action="../controller/deleteOrderAdmin.php" method="POST" onsubmit="return confirmdelete()">
                    <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                    <input type="submit" value="delete" class="btn">
                </form>
                <form action="../controller/openTerminal.php" method="POST">
                    <input type="text" name="idBid" id="idBid" value="<?php echo $row["idBid"]?>">
                    <input type="submit" value="open a terminal" class="btn">
                </form>
            </td>
        </tr>
<?php
        }
        ?>
    </center>
        <?php
    }
?>
