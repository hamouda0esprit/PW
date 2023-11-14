<?php
    require_once("..\Model\config.php"); 
    $countbox = 0;
    $countannim = 0.5;
    $bd = new config();
    $po = $_POST["point"];
    $userid = $_POST["clientId"];
    print "user id = $userid";
        $pdo = $bd::getConnexion();
        try{
            $query = $pdo->prepare(
               "UPDATE `delivery_point` SET `Points`='$po' WHERE `id_client` = '$userid' "
            );

            $query->execute();

            header("Location: ../view/Main_page.php");
            exit();
        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        ?>