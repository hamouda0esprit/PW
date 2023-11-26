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
            "SELECT c.`idcolis`, c.`id_client`, u.`nom` AS client_nom, u.`prenom` AS client_prenom, c.`depart`, c.`arrivee`, c.`size`, c.`poids`, c.`budget`, i.`bin_image`
            FROM `colis` c
            JOIN `user` u ON c.`id_client` = u.`ID`
            LEFT JOIN `images` i ON c.`idcolis` = i.`idcolis`"
        );

            $query->execute();
            $result = $query->fetchAll();

        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){
?>
<tr>
<td> <?php echo  $row['client_nom']." ".$row['client_prenom']?></td>
        <td> <?php echo  $row['size']?></td>
        <td><?php echo  $row['poids']?></td>
        <td><?php echo  $row['depart']?></td>
        <td><?php echo  $row['arrivee']?></td>
        <td><?php echo  $row['budget']?></td>
        <td>
                        <?php
                        if (!empty($row['bin_image'])) {
                            // Display the first image for simplicity. You can loop through all images if needed.
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['bin_image']) . '" width="50" height="50" />';
                        } else {
                            echo 'No image available';
                        }
                        ?>
                    </td>
        <td class="button-container">
          <form action="..\controller\update_form.php" method="POST"><input type="text" id="update" name="update_id" value="<?php echo $row['idcolis']?>" style="display:none;"/> <button class="modify-button" onclick="modifyDelivery(this)">Modify</button></form>
          <form action="..\controller\delete.php" method="POST"><input type="text" id="delete" name="delete_id" value="<?php echo $row['idcolis']?>" style="display:none;"/><button class="suppress-button" onclick="suppressDelivery(this)">Suppress</button></form>
        </td>
      </tr>
      <?php 
}} 
?>