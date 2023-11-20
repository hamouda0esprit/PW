<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once("../controller/navbar.php"); 
        navbar();
        require_once("..\controller\activeDeliveries.php"); 
        ?>
        <center>
        <?php 
        showActiveDeliveries();
        ?>
        </center>
        <?php 
    ?> 
</body>
</html>