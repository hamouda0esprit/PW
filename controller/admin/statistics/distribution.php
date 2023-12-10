<?php
    function distribution(){
?>
    <div class="distributionData" style="display:none">
<?php
        require_once("..\..\model\config.php"); 
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            // Sélectionner le nombre de clients
            $queryClients = $pdo->prepare("SELECT COUNT(*) AS nombre_de_clients FROM data where SUBSTR(ID,1,1) = 'C' ");
            $queryClients->execute();
            $resultClients = $queryClients->fetch();

            // Sélectionner le nombre de livreurs
            $queryLivreurs = $pdo->prepare("SELECT COUNT(*) AS nombre_de_livreurs FROM  data where SUBSTR(ID,1,1) = 'L'");
            $queryLivreurs->execute();
            $resultLivreurs = $queryLivreurs->fetch();
?>
        <p class="dataDistribution"><?php echo($resultClients['nombre_de_clients']); ?></p>
        <p class="labelDistribution">user</p>
        <p class="dataDistribution"><?php echo($resultLivreurs['nombre_de_livreurs']); ?></p>
        <p class="labelDistribution">driver</p>
<?php
        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
?>
    </div>
        <canvas id="distribtionCanvas" aria-lable="chart" role="img"></canvas>
<?php
    }
?>