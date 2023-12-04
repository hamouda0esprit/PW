<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\controller\activeDeliveries\activeDeliveries.css">
    <link rel="stylesheet" href="../controller/navbar/navbar.scss">
</head>
<body>
    <?php 
        require_once("../controller/navbar/navbar.php"); 
        navbar();
        require_once("..\controller\activeDeliveries\activeDeliveries.php"); 
        ?>
        <center>
        <?php 
        showActiveDeliveries();
        ?>
        </center>
        <?php 
    ?>  

    <script src="..\controller\activeDeliveries\activeDeliveries.js"></script>
    <script src="..\controller\activeDeliveries\bidFormControl.js"></script>
</body>
</html>