<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\navbar.css">
</head>
<body>
    <?php 
    function navbar(){
    $identity = "C"; 
    
    ?>
    <nav class="navbar">
        <img src="../Assets/logo.png" alt="Delivery Link">
        <div class="links">
<?php
    if ($identity == "C"){    
?>
            <a href="#">Home</a>
            <a href="showAD.php">Dashboard</a>
            <a href="showMO.php">Services</a>
<?php
    }else if ("L"){
?>
            <a href="#">Home</a>
            <a href="showAD.php">Dashboard</a>
            <a href="showMO.php">Services</a>
<?php
    }else{
?>      
            <a href="#">Home</a>
            <a href="showAD.php">Dashboard</a>
            <a href="showAMO.php">Services</a>
<?php
    }
?>
        </div>
    </nav>

    <?php
    }
    ?>
</body>
</html>