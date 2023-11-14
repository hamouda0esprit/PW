<?php

require_once("..\Model\config.php");


$sql = "DELETE FROM colis WHERE idcolis = 9";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }

        ?>