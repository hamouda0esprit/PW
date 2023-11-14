<!DOCTYPE html>
<html>
<head>
    <title>Deliverable Points Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            margin: 0 auto;
            max-width: 400px;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
        require_once("..\model\config.php");
	
		$bd = new config();
        $pdo = $bd::getConnexion();
	?>
    <div class="container">
        <h1>Deliverable Points Calculator</h1>
        <form id="calculator-form" action="../controller/controller.php" method = "POST">
            <label for="clientId">Select Client:</label>
            <select id="clientId" name="clientId" onchange="updateSelectedValue()">
                <?php
                    $iduser;
					try{
						$query = $pdo->prepare('SELECT `id_client` FROM `delivery_point`');
						$query->execute();
						$result = $query->fetchAll();
					}
					catch(PDOExcepion $e){
						echo "connection failed :". $e->getMessage();
					}
					foreach($result as $row){
				?>
                <option value="<?php echo $row["id_client"]?>">Client <?php echo $row["id_client"]?></option>
                <?php } ?>
            </select>
            <p id="selectedValueParagraph">Selected Value: </p>
            <script>
        function updateSelectedValue() {
            // Get the select element
            var select = document.getElementById('clientId');

            // Get the selected value
            var selectedValue = select.value;

            // Update the paragraph with the selected value
            var selectedValueParagraph = document.getElementById('selectedValueParagraph');
            selectedValueParagraph.textContent = 'Selected Client ID: ' + selectedValue;

            // You can now use the variable 'selectedValue' for further processing
            console.log('Selected Client ID:', selectedValue);
        }
        </script>
            
            <br>
            <p id="selectedUserName"></p>
            <br>
            <label for="pointsPerTask">Points per Task:</label>
            <input type="number" id="point" name="point" min="0" value="1" required>
            <br>
            <button type="submit" id="calculateButton">Calculate Points</button>
        </form>
        <div id="result"></div>
    </div>

    <script>
       

    </script>
</body>
</html>
