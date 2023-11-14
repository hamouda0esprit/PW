<?php 
    include ("Chat.php");
    require("Connection.php");
    $mess = new Chat($_POST["msg"]);
    try{
        $query = $pdo->prepare(
            'INSERT INTO Chat (msg,nom) VALUES(:msg,:nom)'
        );
        $query->execute([
            'msg' => $mess->msg,
            'nom' => 'vr',

        ]);
    }catch(PDOException $e){
        echo'Connection failure :'. $e->getMessage();
    }
    header("Location: Index.php");
    exit();
?>