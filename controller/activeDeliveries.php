<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../activeDeliveries.css">
</head>
<body>
    <center>
    <?php
        require_once("..\Model\config.php"); 
        $countbox = 0;
        $countannim = 0.5;
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            $query = $pdo->prepare(
                'SELECT u.nom, u.prenom, a.depart, a.arrive, a.size, a.poid, MIN(b.montant) AS montant_minimum FROM user u JOIN activedeliveries a ON u.ID = a.ID LEFT JOIN bids b ON a.idDeliveries = b.idDeliveries GROUP BY u.nom, u.prenom, a.depart, a.arrive, a.size, a.poid;'
            );

            $query->execute();
            $result = $query->fetchAll();

        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){
            ?>
    <div class="cardActDel" style="animation-duration:<?php echo $countannim;$countannim = $countannim +0.5;?>s;">
        <div class="cardTile">
            <p>Get an estimate for your delivery</p>
        </div>  
        <div class="cardInfo">
            <div class="useInfo">
                <p>user</p>
                <img src="../Assets/userlogo.png" alt="user">
                <h3><?php echo $row["prenom"]  ?></h3>
                <h4><?php echo $row["nom"]  ?></h4>
            </div>
            <div class="delInfo">
                <p>Delivery Info</p>
                <b><p><?php echo $row["depart"]  ?> -> <?php echo $row["arrive"]  ?></p></b>
                <b><p><?php echo $row["size"]  ?></p></b>
                <b><p><?php echo $row["poid"]  ." kg"?></p></b>
            </div>
            <div class="bidInfo">
                <p>BID</p>
                <img src="../Assets/bidLogo.png" alt="bid">
                <p>Current Bid</p>
                <p><?php
                if($row["montant_minimum"] == "")
                    echo "-- DT";
                else
                echo $row["montant_minimum"] ." DT";
                 ?></p>
            </div>
            
        </div>
        <div class="btnDet">
            <button class="bidBtn" onclick="hideBid(<?php 
                echo $countbox;
                $countbox++;
            
            ?>)"><b>Start Bidding</b></button>
        </div>
        <div class="bidForm hide">
            <h3 class="bidTitle">bid form</h3>
                <form action="" method="POST">        
                    <input type="number" name="bid" id="bid" placeholder="bid">
                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="comment"></textarea>
                    <input type="submit" value="BID" id="sendBid">
                </form>
            </div>
    </div>

            <?php
        }



    ?>
    </center>
    <script src="..\activeDeliveries.js"></script>
</body>
</html>