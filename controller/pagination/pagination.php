<?php
function pagination($act){	
?>
		<?php
	require_once("..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $query = $pdo->prepare("SELECT CEILING(COUNT(`idBid`)/10) as nb  FROM `colis_a_encherer` WHERE `idLivreur`=1;");

        $query->execute();
        $result = $query->fetchAll();

    }catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){

?>

	<div class="paginationDiv">

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="goStart">
			<input type="text" name="nbpage" id="goStartVal" style="display:none;" value="1">
			<button type="submit" class="pagBtn"><<</button>
		</form>
<?php
	if($act > 1){
?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="goPred">
			<input type="text" name="nbpage" id="goPredVal" style="display:none;" value="<?php echo strval( intval($act) - 1 )?>">
			<button type="submit" class="pagBtn"><</button>
		</form>
<?php
	}
?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="changePage">
			<select name="nbpage" id="nbpage" onchange="this.form.submit()">
				<?php 
					for($i=1;$i<= $row["nb"] ;$i++){
				?>
				<option value="<?php echo $i?>" <?php if($i == $act) echo "selected" ;?>><?php echo $i?></option>
				<?php
					}
				?>
			</select>
			<p>of <?php echo $row["nb"] ?></p>
		</form>
<?php
	if($act < $row["nb"]){
?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="goNext">
			<input type="text" name="nbpage" id="goNextVal" style="display:none;" value="<?php echo strval( intval($act) + 1 )?>">
			<button type="submit" class="pagBtn">></button>
		</form>
<?php
	}
?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="goLast">
			<input type="text" name="nbpage" id="goLastVal" style="display:none;" value="<?php echo $row["nb"] ?>">
			<button type="submit" class="pagBtn">>></button>
		</form>

	</div>	 
<?php
	}
}
?>


