<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limite de Caractères</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        #charCount {
            color: #333;
            font-size: 14px;
            margin-top: 5px;
        }
        .btn-remove {
        transition: background-color 0.3s ease;
        }

    .btn-remove:hover {
        background-color: #e74c3c; /* Changez la couleur au survol selon vos préférences */
    }

   /* Ajoutez ces styles CSS dans votre balise <style> existante */

   .btn-ban-creative-animation {
    background-color: #4caf50; /* Couleur de fond initiale (rouge) */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    overflow: hidden;
    position: relative;
    transition: background 0.5s, transform 0.5s, box-shadow 0.5s;
}

.btn-ban-creative-animation:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, transparent, #e74c3c); /* Dégradé de gauche à droite */
    transition: left 0.5s;
}

.btn-ban-creative-animation:hover {
    background-color: #c0392b; /* Nouvelle couleur de fond au survol */
    transform: scale(0.9); /* Réduire légèrement la taille */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Ajouter une ombre légère */
}

.btn-ban-creative-animation:hover:before {
    left: 0;
}


    </style>
</head>
<body>
<?php
function getAdmin()
{
    require_once("config2.php");
    $bd = new config();
    $pdo = $bd::getConnexion();

    /*jointure entre table messages et table report **/

    try {
        $query = $pdo->prepare(
            'SELECT r.userid as userid, r.report_id  AS request_id, m.msg_id, m.msg AS message
                FROM report r
                JOIN messages m ON r.msg_id = m.msg_id;'
        );

        $query->execute();
        $result = $query->fetchAll();
    } catch (PDOException $e) {
        echo "connection failed :" . $e->getMessage();
    }
    foreach ($result as $row) {
?>
        <tr>
        
            <td><?php echo "#" . $row["userid"] ?></td>
            <td><?php echo $row["message"] ?></td>
            <td>
                <form action="php/ban.php" method="POST" onsubmit="return confirmdelete()">
                    <input type="text" name="request_id" style="display:none;" value="<?php echo $row["msg_id"] ?>">
                    <input type="submit" name="action" value="ban" class="btn btn-ban-creative-animation">
                    <input type="text" name="id" style="display:none;" value='<?php echo $row["userid"] ?>'>
                    <input type="text" name="request_id" style="display:none;" value="<?php echo $row["request_id"] ?>" oninput="limitCharacters(this, 15, 'charCount_<?php echo $row["request_id"]; ?>')">
                    <input type="submit" name="action" value="remove" class="btn btn-remove">
                    <textarea name="reason" cols="30" rows="10" oninput="limitCharacters(this, 15, 'charCount_<?php echo $row["request_id"]; ?>')" placeholder="Enter reason" required></textarea>
                    <p id="charCount_<?php echo $row["request_id"]; ?>">0 / 15 caractères</p>

                    <script>
                        function limitCharacters(element, maxLength, charCountId) {
                            // Récupérer la valeur du champ
                            var inputValue = element.value;

                            // Limiter la longueur à maxLength caractères
                            var limitedValue = inputValue.slice(0, maxLength);

                            // Mettre à jour la valeur du champ
                            element.value = limitedValue;

                            // Mettre à jour le compteur de caractères
                            document.getElementById(charCountId).textContent = limitedValue.length + ' / ' + maxLength + ' caractères (maximum)';
                        }
                    </script>
                </form>
            </td>
        </tr>
<?php
    }
}
?>
</body>

</html>