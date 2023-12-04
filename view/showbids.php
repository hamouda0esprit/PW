<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Deliveries</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    h2 {
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: rgb(255, 215, 0);
      color: white;
    }

    .button-container {
      margin-top: 10px;
    }

    .modify-button, .suppress-button, .bids-button {
      padding: 5px 10px;
      margin-right: 5px;
      cursor: pointer;
    }

    .modify-button {
      background-color: #4285f4; /* Modify button color */
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 20px 0px rgba(0, 0, 0, .1), 4px 4px 5px 0px rgba(0, 0, 0, .1);
      transition: all 0.3s ease;
      color: white;
    }
    .modify-button:hover {
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 25px 0px rgba(0, 0, 0, .1), 4px 4px 6px 0px rgba(0, 0, 0, .3);
    }

    .suppress-button {
      background-color: #dc3545; /* Suppress button color */
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 20px 0px rgba(0, 0, 0, .1), 4px 4px 5px 0px rgba(0, 0, 0, .1);
      transition: all 0.3s ease;
      color: white;
    }
    .suppress-button:hover {
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 25px 0px rgba(0, 0, 0, .1), 4px 4px 6px 0px rgba(0, 0, 0, .3);
    }

    .bids-button {
      background-color: #28a745; /* Bids button color (green) */
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 20px 0px rgba(0, 0, 0, .1), 4px 4px 5px 0px rgba(0, 0, 0, .1);
      transition: all 0.3s ease;
      color: white;
    }
    .bids-button:hover {
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 25px 0px rgba(0, 0, 0, .1), 4px 4px 6px 0px rgba(0, 0, 0, .3);
    }

    .buttons-container{
        display:flex;
        flex-direction:row;
        margin-right:-5vw;
    }

    .buttons-container .box-right{
        height:25px;
        width:35px;
        display:flex;
        justify-content: center;
        align-items: center;

        margin-right:1vw;
        margin-left:5vw;

        border-bottom-left-radius:50%;
    }
    .buttons-container .box-right:hover{
        background-color:red;
        transition: all 0.3s ease;
    }

    .buttons-container .box-left{
        height:25px;
        width:35px;
        display:flex;
        justify-content: center;
        align-items: center;

        border-bottom-right-radius:50%;
    }
    .buttons-container .box-left:hover{
        background-color:lightgreen;
        transition: all 0.3s ease;
    }

    .submitions-thingies{
        display:flex;
        flex-direction:row;
    }
  </style>
</head>
<body>
  <h2>My Bids</h2>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>idcolis</th>
        <th>montant</th>
        <th>dateDepart</th>
        <th>dateArrivee</th>
        <th>Comment</th>
       
  
      </tr>
    </thead>
    <tbody>
    <?php
function select()
{
    require_once("..\model\config.php");

    $bd = new config();
    $pdo = $bd::getConnexion();
    try {
        $query = $pdo->prepare(
            "SELECT 
            cae.idcolis,
            cae.idBid,
            cae.montant,
            cae.dateDepart,
            cae.dateArrive,
            cae.comment,
            l.nom AS livreur_nom,
            l.prenom AS livreur_prenom
        FROM 
            colis_a_encherer cae
        JOIN 
            livreur l ON cae.idLivreur = l.idLivreur
        WHERE 
            cae.status != -1;
        "
        );

        $query->execute();
        $result = $query->fetchAll();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

    
        <?php
        foreach ($result as $row) {
            ?>
            <tr>
                <td> <?php echo $row['livreur_nom'] . " " . $row['livreur_prenom'] ?></td>
                <td> <?php echo $row['idcolis'] ?></td>
                <td> <?php echo $row['montant'] ?></td>
                <td> <?php echo $row['dateDepart'] ?></td>
                <td> <?php echo $row['dateArrive'] ?></td>
                <td class="submitions-thingies"> <?php echo $row['comment'] ?>
                
                
                <div class="buttons-container"> 
                    
                    <form action="..\controller\updatebid.php" method="POST">
                    <input type="text" name="idBid" style="display:none;" value="<?php echo  $row['idBid'] ?>">
                    <button class="box-right" type="submit">
                    <svg width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.8265 18.2213L15.8478 13.2426L20.8266 8.26375C21.0534 8.03695 21.2372 7.23718 20.6212 6.62125C20.0053 6.00532 19.2055 6.18915 18.9787 6.41593L13.9999 11.3948L9.02111 6.41595C8.79436 6.18915 7.99456 6.00531 7.37866 6.62122C6.76275 7.23713 6.94656 8.03695 7.17334 8.26372L12.1522 13.2426L7.17334 18.2214C6.94659 18.4481 6.7627 19.2479 7.37866 19.8639C7.99462 20.4798 8.79441 20.296 9.02116 20.0692L14 15.0904L18.9788 20.0692C19.2056 20.296 20.0054 20.4798 20.6213 19.8639C21.2373 19.2479 21.0533 18.4481 20.8265 18.2213Z" fill="#333"/>
</svg></button > 
</form>

<form action="..\payment\index.html" method="POST">
<button class="box-left" type="submit"><svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.5175 0.482886C16.8737 -0.160962 15.8304 -0.160962 15.1866 0.482886L5.38319 10.2862L2.77648 8.04706C2.14142 7.41197 1.1119 7.41197 0.47629 8.04706C-0.158763 8.68211 -0.158763 9.71216 0.47629 10.3472L4.37073 13.6923C5.00578 14.3274 6.0353 14.3274 6.67091 13.6923C6.73465 13.6286 6.78794 13.5577 6.83903 13.4868C6.84835 13.478 6.8588 13.472 6.86815 13.4632L17.5176 2.81325C18.1608 2.16996 18.1608 1.12617 17.5175 0.482886Z" fill="#333"/>
</svg></button>
</form>
</div></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    </body>
    </html>
    <?php
}

select();  // Call the function to display the data
?>

    </tbody>
  </table>

 
</body>
</html>
