
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
<ul class="nav">
          <li>  <a href="#">Home</a></li>
           <li> <a href="showAD.php">Dashboard</a></li>
          <li>  <a href="showMO.php">Services</a></li>
            </ul>
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
