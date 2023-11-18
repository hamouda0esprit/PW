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
    function showActiveDeliveries(){ 
        require_once("..\model\config.php"); 
        $countbox = 0;
        $countannim = 0.3;
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            $query = $pdo->prepare(
                'SELECT u.nom, u.prenom, a.depart, a.arrivee, a.idcolis, a.size, a.poids,a.budget, MIN(b.montant) AS montant_minimum FROM user u JOIN colis a ON u.ID = a.id_client LEFT JOIN colis_a_encherer b ON a.idcolis = b.idcolis GROUP BY u.nom, u.prenom, a.depart, a.arrivee, a.size, a.poids,a.budget;'
            );

            $query->execute();
            $result = $query->fetchAll();

        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){
            ?>
    <div class="cardActDel" style="animation-duration:<?php echo $countannim;$countannim = $countannim +0.3;?>s;">
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
                <b><p><?php echo $row["depart"]  ?> -> <?php echo $row["arrivee"]  ?></p></b>
                <b><p><?php echo $row["size"]  ?></p></b>
                <b><p><?php echo $row["poids"]  ." kg"?></p></b>
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
                <form action="..\controller\addBid.php" method="POST" onsubmit="return control(<?php echo ($countbox-1);?>)">        
                    <input type="number" class="normal" name="idDeliveries" id="idDeliveries" value="<?php echo $row["idcolis"]?>">
                    <input type="text" class="normal" name="montant" id="bid" placeholder="bid">
                    <div id="dateHolder">
                        <input type="date" class="normal" name="dateDepart" id="dateDepart" placeholder="Date Depart">
                        <input type="date" class="normal" name="dateArrive" id="dateArrive" placeholder="Date Arrive">
                    </div>
                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="comment"></textarea>
                    <input type="submit" value="BID" id="sendBid">
                </form>
            </div>
    </div>

            <?php
        }
    }


    ?>
    </center>
    <script src="..\activeDeliveries.js"></script>
    <script src="..\bidFormControl.js"></script>
</body>
</html>