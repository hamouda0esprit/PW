<?php 

function updateStatus(){
    $state = 0;
    require_once("..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $query = $pdo->prepare('SELECT status FROM colis_a_encherer WHERE idBid = :idBid');
        $query->bindParam(':idBid', $_POST["idBid"], PDO::PARAM_INT);
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
    <h2>Update Order #<?php echo $_POST["idBid"] ?></h2>
    <div class="icons">
        <div>
            <i class="fa-solid fa-check fa-bounce <?php if($state>=1) echo "done"; ?>  icn" style="--fa-animation-iteration-count: 1;"></i>
            <h3 class="<?php if($state>=1) echo "done"; ?>"><b>confirmed</b></h3>
        </div>
        <div>
            <i class="fa-solid fa-arrow-right fa-bounce <?php if($state>=1) echo "done"; ?> icn"   style="--fa-animation-iteration-count: 1;"></i>
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
    <?php 
        if($state != 3){
    ?>
    <form action="..\controller\updateStatus\updateStateDataBase.php" method="post">
        <input type="text" name="state" id="state" style="display:none;" value="<?php echo $state ?>">
        <input type="text" name="idBid" id="idBid" style="display:none;" value="<?php echo $_POST["idBid"] ?>">
        <input type="submit" value="<?php 
            if($state == 1){
                echo("collect");
            }else{
                echo("delliver");
            }
        ?>">
    </form>
    <?php 
        }
    ?>
</div>
<?php


}

?>