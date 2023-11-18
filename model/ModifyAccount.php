<?php 

    require("Connection.php"); 
    $bd = new Connection();
    $pdo = $bd::getConnexion();
    $Delete = $_POST['Delete'];
    session_start();
    $ID = $_SESSION['ID'];
    if ($Delete == 'Yes') {
        $req = 'DELETE FROM data WHERE ID = :ID;';
        $query = $pdo->prepare($req); // Prepare the SQL statement
        $query->bindParam(':ID', $ID);
        $query->execute();
        echo'Account Deleted';
        echo "<p id='countdown'>Returning in 5 seconds...</p>";
            ?>
            <script>
            window.onload = function() {
                var countdown = 3;
                var timer = setInterval(function() {
                    document.getElementById('countdown').innerHTML = 'Returning in ' + countdown + ' seconds...';
                    countdown--;
                    if (countdown < 0) {
                        clearInterval(timer);
                        document.getElementById('countdown').style.display = 'none'; // Hide the countdown
                        window.location.href = '../view/Account.php'; 
                    }
                }, 1000); // Update every 1 second (1000 milliseconds)
            }
            </script>
            <?php
    }else{
        try{
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numero = $_POST['numero'];
            $password = $_POST['password'];
            $query = $pdo->prepare("UPDATE data SET nom = :nom, prenom = :prenom, email = :email, numero = :numero , password = :password WHERE ID = :ID");
            $query->bindParam(':nom', $nom);
            $query->bindParam(':prenom', $prenom);
            $query->bindParam(':email', $email);
            $query->bindParam(':numero', $numero);
            $query->bindParam(':password', $password);
            $query->bindParam(':ID', $ID);
            $query->execute();
            echo'Account Modified';
            echo "<p id='countdown'>Returning in 5 seconds...</p>";
            ?>
            <script>
            window.onload = function() {
                var countdown = 3;
                var timer = setInterval(function() {
                    document.getElementById('countdown').innerHTML = 'Returning in ' + countdown + ' seconds...';
                    countdown--;
                    if (countdown < 0) {
                        clearInterval(timer);
                        document.getElementById('countdown').style.display = 'none'; // Hide the countdown
                        window.location.href = '../view/Account.php'; 
                    }
                }, 1000); // Update every 1 second (1000 milliseconds)
            }
            </script>
            <?php
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    
?>