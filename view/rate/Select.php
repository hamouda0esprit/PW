<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design.css">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("..\..\model\config.php");
		$bd = new config();
        $pdo = $bd::getConnexion();
	?>
<div class="container">
        <h1>Deliver Link Points</h1>
        <form id="calculator-form" action="rate_livreur.php" method = "POST" onsubmit = "return validateForm()">
        <label for="type">type:</label>
        <select name="type" id="type">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>   
        <label for="clientId">Select Client:</label>
            
            <select id="clientId" name="clientId" onchange="updateSelectedValue()">
                <?php
                    $iduser;
					try{
						$query = $pdo->prepare('SELECT * FROM `delivery_point`');
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
            <label for="idLivreur">Select Client:</label>
            <select id="idLivreur" name="idLivreur" onchange="updateSelectedValueLivreur()">
                <?php
                    $iduser;
					try{
						$query = $pdo->prepare('SELECT * FROM `livreur`');
						$query->execute();
						$result = $query->fetchAll();

					}
					catch(PDOExcepion $e){
						echo "connection failed :". $e->getMessage();
					}
					foreach($result as $row){
				?>
                <option value="<?php echo $row["idLivreur"]?>">Client <?php echo $row["idLivreur"]?></option>
                <?php } ?>
            </select>
            <script>
        function updateSelectedValueLivreur() {
            // Get the select element
            var select = document.getElementById('idLivreur');

            // Get the selected value
            var selectedValuelivreur = select.value;

            // Update the paragraph with the selected value
            var selectedValueParagraph = document.getElementById('selectedValueParagraph2');
            selectedValueParagraph.textContent = 'Selected livreur ID: ' + selectedValuelivreur;

            // You can now use the variable 'selectedValue' for further processing
            console.log('Selected Client ID:', selectedValuelivreur);
        }
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
            <p id="selectedValueParagraph2">Selected Value: </p>
           
            <div class="button">
            <button type="submit" id="calculateButton">Submit</button>
            </div>
          
        <div id="result"></div>
    </div>
    </form>
    </script src ="verification.js">
</body>
</html>