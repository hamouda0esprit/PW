<?php

function getMyTask($act){
    $avencement = strval(intval($act) - 1)."0";
    require_once("..\..\model\config.php"); 
    $bd = new config();
    $pdo = $bd::getConnexion();
    try{
        $query = $pdo->prepare("
            SELECT c.`idcolis`, c.`id_client`, u.`nom` AS client_nom, u.`prenom` AS client_prenom, c.`depart`, c.`arrivee`, c.`size`, c.`poids`, c.`budget`, i.`bin_image`
            FROM `colis` c
            JOIN `data` u ON c.`id_client` = u.`ID`
            LEFT JOIN `images` i ON c.`idcolis` = i.`idcolis`
            WHERE c.`id_client` = :id
            LIMIT 10 OFFSET $avencement;
        ");

        $query->execute([
            ':id' => 'C1', // Adjust the value accordingly
        ]);

        $result = $query->fetchAll();

    }catch(PDOExcepion $e){
        echo "connection failed :". $e->getMessage();
    }
    foreach($result as $row){
?>
    <tr>
        <td class="tdId"><p><?php echo $row['idcolis'] ?></p></td>
        <td class="tdUser"><p><?php echo $row['size'] ?></p></td>
        <td><p><?php echo $row['poids'] ?></p></td>
        <td><p><?php echo $row['depart'] ?></p></td>
        <td><p><?php echo $row['arrivee'] ?></p></td>
        <td><p><strong><?php echo $row["budget"] ?> DT</strong></p></td>
        <td><?php
                        if (!empty($row['bin_image'])) {
                            // Display the first image for simplicity. You can loop through all images if needed.
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['bin_image']) . '"/>';
                        } else {
                            echo 'No image available';
                        }
                        ?></td>
        <td>
        <form action="..\..\view\user\showBidsColis.php" method="POST"><input type="text" id="bid" name="bid_id" value="<?php echo $row['idcolis']?>" style="display:none;"/><button class="btn updateStatus" onclick="bidsAction() ">bids</button></form>
          <form action="updateForm.php" method="POST"><input type="text" id="update" name="update_id" value="<?php echo $row['idcolis']?>" style="display:none;"/> <button class="btn update" onclick="modifyDelivery(this)">Modify</button></form>
          <form action="..\..\controller\user\mytask\delete.php" method="POST"><input type="text" id="delete" name="delete_id" value="<?php echo $row['idcolis']?>" style="display:none;"/><button class="btn delete" onclick="suppressDelivery(this)">Suppress</button></form>
        </td>
    </tr>
<?php
    }
}
?>
