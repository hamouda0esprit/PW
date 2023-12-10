<?php 

function showStatus(){
    $state = 0;
    require_once("..\..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $query = $pdo->prepare('SELECT * FROM colis_a_encherer WHERE idBid = :idBid');
        $query->bindParam(':idBid', $_POST["idbid"], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();

    }catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){
        $state = $row["status"];
    }
?>
<div class="updateStatus">
    <h2>Follow Package #<?php echo $row["idcolis"] ?></h2>
    <div class="icons">
        <div>
            <i class="fa-solid fa-check fa-bounce <?php if($state>=1) echo "done"; ?>  icn" style="--fa-animation-iteration-count: 1;"></i>
            <h3 class="<?php if($state>=1) echo "done"; ?>"><b>confirmed</b></h3>
        </div>
        <div>
            <i class="fa-solid fa-bounce fa-arrow-right  <?php if($state>=1) echo "done"; ?> icn"   style="--fa-animation-iteration-count: 1;"></i>
        </div>
        <div>
            <i class="fa-solid fa-truck fa-bounce icn <?php if($state>=2) echo "done"; ?>" style="--fa-animation-iteration-count: 1;"></i>
            <h3 class="<?php if($state>=2) echo "done"; ?>"><b>collected</b></h3>
        </div>
        <div>
            <i class="fa-solid fa-arrow-right fa-bounce icn <?php if($state>=2) echo "done"; ?>"  style="--fa-animation-iteration-count: 1;"></i>
        </div>
        <div>
            <i class="fa-solid fa-house fa-bounce icn <?php if($state>=3) echo "done"; ?>" style="--fa-animation-iteration-count: 1;"></i>
            <h3 class="<?php if($state>=3) echo "done"; ?>"><b>dellivered</b></h3>
        </div>
    </div>
</div>
<?php


}

?>