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
      function select(){
        require_once("..\Model\config.php"); 
       
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            $query = $pdo->prepare(
                'SELECT `idcolis`, `id_client`, `depart`, `arrivee`, `size`, `poids`, `budget` FROM `colis` '
            );

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
          <button class="modify-button" onclick="modifyDelivery(this)">Modify</button>
          <button class="suppress-button" onclick="suppressDelivery(this)">Suppress</button>
        </td>
      </tr>
      <?php 
}} 
?>