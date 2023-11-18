<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <?php
      function admin(){
        $filterC = "";
        $sqlSelectLine = "";
        if (isset($_POST["selectClient"])) {
            $filterC = $_POST["selectClient"];
        }else{
            $filterC = "-1";
        }
        if ($filterC == "-1") {
            $sqlSelectLine = 'SELECT `idcolis`, `id_client`, `depart`, `arrivee`, `size`, `poids`, `budget` FROM colis;';
        } else {
            $sqlSelectLine = 'SELECT `idcolis`, `id_client`, `depart`, `arrivee`, `size`, `poids`, `budget` FROM colis WHERE id_client = ' . $filterC;
        }
        ?>
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
            <input type="reset" value="CLEAR">
            <input type="submit" value="SORT">
            </form>
        <?php
        require_once("..\Model\config.php"); 
       
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
<tr>
        <td> <?php echo  $row['size']?></td>
        <td><?php echo  $row['poids']?></td>
        <td><?php echo  $row['depart']?></td>
        <td><?php echo  $row['arrivee']?></td>
        <td><?php echo  $row['budget']?></td>
        <td class="button-container">
          <form action="..\controller\deleteAdmin.php" method="POST"><input type="text" id="delete" name="delete_id" value="<?php echo $row['idcolis']?>"/><button class="suppress-button" onclick="suppressDelivery(this)">Suppress</button></form>
        </td>
      </tr>
      <?php 
}} 
?>  