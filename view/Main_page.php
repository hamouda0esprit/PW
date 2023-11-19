<!DOCTYPE html>
<html>
<head>
    <title>Delivelink Points</title>
    <link rel="stylesheet" type="text/css" href="design.css">
       
</head>
<body>
    <?php
        require_once("..\model\config.php");
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
        $somme=0;
        if (count($result) > 0){
        foreach ($result as $row){ 
        ?>
        <tr>
            <td><?php 
            echo $row["idDeliveries"];
            ?></td>
            <td>
            <?php 
            echo $row["montant"];
            ?>
            </td>
            <td>
            <?php 
            $prix= $row["montant"];
            $somme = $somme + (int)($prix/10);
            echo (int)($prix/10) ;
            ?>
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
        echo "noooooooooo";
    }
    $query = $pdo->prepare("UPDATE delivery_point SET Points = :Points WHERE id_client = :id_client");
    $query->bindParam(':Points', $somme);
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
        <div class = "percent">0</div>
        <div class="pp"></div>
        <div class = "progress_bar"> 
            
            <div class = "progress">
              
                <?php
                $id_client = $_POST["clientId"];
                $query = $pdo->prepare("SELECT * FROM `delivery_point` WHERE id_client = :id_client");
                $query->bindParam(':id_client', $id_client);
                $query->execute();
                $result = $query->fetchAll();
                $Data = $result[0];
                $Points = $Data['Points'];
                if($Points > 0){
                echo'
                <script>
                    var percent = document.querySelector(".percent");
                    var progress = document.querySelector(".progress");
                    var pp = document.querySelector(".pp");
                    var count = 0 ;
                    var per = 0;
                    var goal =230;
                    var loading = setInterval(Calcul,50);
                    function Calcul(){
                    if(count == '. $Points .' && per == '. $Points .' ){
                    clearInterval(loading);}
                    
                    else{
                        per = per + 1;
                        count = count + 1;
                        progress.style.width = (count*100)/goal + "%";
                        percent.textContent = count + "/" + goal ;
                        pp.textContent = ((count*100)/goal).toFixed(1) + "%"; ;
                    } 
                    }
                </script>';}
                else{ echo '
                    <script>
                    var goal =230;
                    var percent = document.querySelector(".percent");
                    var progress = document.querySelector(".progress");
                    var pp = document.querySelector(".pp");
                    progress.style.width = 0 + "%";
                    percent.textContent = "0/" + goal ;
                    pp.textContent = "Pas de credits";
                    </script>
                    ';
                }
            ?>
            </div>
       
                
            </div>
            <div class="button">
            <?php 
            
            
            
            ?>
           
            <script>
        // Function to check the condition
        function checkCondition() {
            // Replace this with your actual condition

            return false; // Enable the button if the condition is true
        }

        // Function to handle button click
        function myFunction() {
            alert("Button clicked!");
        }

        // Disable the button initially if the condition is not met
        document.getElementById("buttonp").disabled = !checkCondition();
    </script>
     <button type="submit" class = "buttonp" onclick="myFunction()">Your Button</button>
            </div>

    </div>
    <script src ="verification.js">
    </script>
</body>
</html>
