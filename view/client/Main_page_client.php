<!DOCTYPE html>
<html>
<head>
    <title>Delivelink Points</title>
    <link rel="stylesheet" type="text/css" href="design.css">
       
</head>
<body>
    <?php
        require_once("..\..\model\config.php");
		$bd = new config();
        $pdo = $bd::getConnexion();
        
	?>
    <h1>Your DeliverLink Points</h1>
    <div class ="historique">
        <table border = 1>
            <tr class = "firstligne">
                <td>
                Id - Livraison
                </td>
                <td class="montant">
                Montant
                </td>
                <td>
                Points(10% Du montant)
                </td>
                <td>
                Status
                </td>
                <td>
                Date d'arrivee
                </td>
                <td>
                Date d'envoie
                </td>
            </tr>
                <?php 
                    $id_client = $_POST["clientId"];
                    $query = $pdo->prepare("SELECT * FROM `bids` WHERE idLivreur = :id_client");
                    $query->bindParam(':id_client', $id_client);
                    $query->execute();
                    $result = $query->fetchAll();
                    $allpoints = 0;
                    $somme=0;
                    $status = 0;
                    if (count($result) > 0){
                        foreach ($result as $row){ 
                ?>
            <tr <?php echo ($row["points_status"] == 1) ? 'class="status-1"' : ''; ?>>
                <td>
                    <?php 
                        echo $row["idDeliveries"];
                    ?>
                </td>
                <td>
                    <?php 
                        echo $row["montant"];
                    ?>
                </td>
                <td>
                    <?php 
                        $status= $row["points_status"];
                        $prix= $row["montant"];
                        $allpoints = $allpoints + (int)($prix/10);
                        if($status == 0){
                        $somme = $somme + (int)($prix/10);
                        }
                        echo (int)($prix/10) ;
                    ?>
                </td>
                <td>
                        <?php echo $status; ?>
                </td>

                <td>
                    <?php 
                        echo $row["dateDepart"];
                    ?>
                </td>
                <td>
                    <?php 
                        echo $row["dateArrive"];
                    ?>
                </td>
            </tr>
                <?php 
                    }}
                    else{
                        echo "Pas de livraison";
                    }
                    $query = $pdo->prepare("UPDATE delivery_point SET Points = :Points WHERE id_client = :id_client");
                    $query->bindParam(':Points', $allpoints);
                    $query->bindParam(':id_client', $id_client);
                    try {
                        $query->execute();
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
        </table>
        <hr class = "hr">
    </div>
    
    <div class = "loading">
        <div class="buttonaa">
            <form action="..\..\controller\controller.php" method="post">
             <input type="hidden" name="clientId" value="<?php echo $id_client; ?>">
                <button type="submit" class="buttona">Use Points</button>
            </form>
        </div>
        <div class = "percent">0</div>
        <div class = "progress_bar">
            <div class="pp"></div> 
            <div class = "progress">
                <?php
                    $id_client = $_POST["clientId"];
                    $query = $pdo->prepare("SELECT * FROM `delivery_point` WHERE id_client = :id_client");
                    $query->bindParam(':id_client', $id_client);
                    $query->execute();
                    $result = $query->fetchAll();
                    $Data = $result[0];
                    $pp = 0;
                    if($somme >= 0){
                        echo'
                            <script>
                                var button = document.querySelector(".buttona");
                                button.disabled = true;
                                var percent = document.querySelector(".percent");
                                var progress = document.querySelector(".progress");
                                var pp = document.querySelector(".pp");
                                var count = 0;
                                var per = 0;
                                var goal = 230;
                                var loading = setInterval(Calcul, 10);

                                function setMaxValue(value, maxValue) {
                                    if (value > maxValue) {
                                        return maxValue;
                                    } else {
                                        return value;
                                    }}

                                function Calcul() {
                                    if (per === '. $somme .') {
                                        clearInterval(loading);
                                    } else {
                                        per = per + 1;
                                        count = count + 1;
                                        progress.style.width = setMaxValue((count * 100) / goal, 100) + "%";
                                        percent.textContent = count + "/" + goal;
                                        pp.textContent = ((count * 100) / goal).toFixed(1) + "%";
                                    }
                                function checkCondition() {
                                    return count >= goal;
                                }
                                function updateButtonState() {
                                    var button = document.querySelector(".buttona");
                                    button.disabled = !checkCondition();
                                }
                                updateButtonState();
                                }
                            </script>'
                    ;}
                    else{ 
                        echo '
                            <script>
                                var goal =230;
                                var percent = document.querySelector(".percent");
                                var progress = document.querySelector(".progress");
                                var pp = document.querySelector(".pp");
                                progress.style.width = 0 + "%";
                                percent.textContent = "0/" + goal ;
                                pp.textContent = "Pas de credits";
                            </script>';}
                ?>
            </div>       
        </div>
    </div>
    <script src ="verification.js">
    </script>
</body>
</html>
