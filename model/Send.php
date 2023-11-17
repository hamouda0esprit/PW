<?php 
    include ("Client.php");
    require("Connection.php");
    $client = new ClientC($_POST["nom"],$_POST["prenom"],$_POST["numero"],$_POST["email"],$_POST["password"]);
    try{
        $query = $pdo->prepare(
            'INSERT INTO data (nom,prenom,numero,email,password) VALUES(:nom,:prenom,:numero,:email,:password)'
        );
        $query->execute([
            'nom' => $client->nom,
            'prenom' => $client->prenom,
            'numero' => $client->numero,
            'email' => $client->email,
            'password' => $client->password
        ]);
        header("Location: ../view/index.php");
        exit();
    }catch(PDOException $e){
        echo'Connection failure :'. $e->getMessage();
    }
?>
