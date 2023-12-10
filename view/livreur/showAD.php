<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Deliveries</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link rel="stylesheet" href="..\..\controller\activeDeliveries\activeDeliveries.css">
    <link rel="stylesheet" href="../../controller/navbar/navbar.scss">
</head>
<body>
    <?php 
        require_once("../../controller/navbar/navbar.php"); 
        navbar();
        require_once("..\..\controller\livreur\activeDeliveries\activeDeliveries.php"); 
        ?>
        <center>
        <?php 
        showActiveDeliveries();
        ?>
        </center>
        <?php 
    ?>  

    <script src="..\..\controller\livreur\activeDeliveries\activeDeliveries.js"></script>
    <script src="..\..\controller\livreur\activeDeliveries\bidFormControl.js"></script>
</body>
</html>