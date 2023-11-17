<?php

require_once("..\Model\config.php");


$sql = "DELETE FROM colis WHERE id_client=1";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }

        ?>