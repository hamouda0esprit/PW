<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="..\client\design.css">
</head>
<body>
<?php
    require_once("..\..\model\config.php");
    $bd = new config();
    $pdo = $bd::getConnexion();
?>
    <h1>Admin Panel</h1>
    
    <form id="clientForm">
        <label for="clientId">Select Client:</label>
        <select id="clientId" name="clientId" onchange="updateSelectedValue()">
            <?php
                $iduser;
                try {
                    $query = $pdo->prepare('SELECT * FROM `delivery_point`');
                    $query->execute();
                    $result = $query->fetchAll();
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                foreach ($result as $row) {
            ?>
                <option value="<?php echo $row["id_client"] ?>">Client <?php echo $row["id_client"] ?></option>
            <?php } ?>
        </select>

        <button type="button" onclick="viewClientInformation()">View Client Information</button>
    </form>

    <div id="clientInfoContainer"></div>

    <script>
        function updateSelectedValue() {
            var select = document.getElementById("clientId");
            var clientId = select.options[select.selectedIndex].value;
            // You can update this line to set the default value for newPoints
        }

        function viewClientInformation() {
            var select = document.getElementById("clientId");
            var clientId = select.options[select.selectedIndex].value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("clientInfoContainer").innerHTML = xhr.responseText;
                }
            };

            xhr.open("GET", "admin_update_client.php?clientId=" + clientId, true);
            xhr.send();
        }

    function updatePoints() {
        console.log("Function called");
   
        var newPoints = document.getElementById("newPoints").value;
        
        var clientId = document.querySelector('input[name="clientId"]').value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("clientInfoContainer").innerHTML = xhr.responseText;
            }
        };

        xhr.open("POST", "admin_update_points.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("clientId=" + clientId + "&newPoints=" + newPoints);
    }
</script>
</body>
</html>
