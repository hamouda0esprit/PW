<?php 
    require("Connection.php"); 
    session_start();
    $bd = new Connection();
    $pdo = $bd::getConnexion();
    $code = $_SESSION['code'];
    $email = $_SESSION['email'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $digit1 = $_POST['digit1'];
        $digit2 = $_POST['digit2'];
        $digit3 = $_POST['digit3'];
        $digit4 = $_POST['digit4'];
        $verificationCode = $digit1 . $digit2 . $digit3 . $digit4;
        if($verificationCode == $code){
            $req = 'UPDATE data SET status = 1 WHERE email = :email';
            $query = $pdo->prepare($req); // Prepare the SQL statement
            $query->bindParam(':email', $email);
            $query->execute();
            echo "Email verified!";
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
                        document.getElementById('countdown').style.display = 'none';
                        window.location.href = '../view/Management.php'; 
                    }
                }, 1000);
            }
            </script>
            <?php
        }else{
            echo "Wrong code!";
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
                        document.getElementById('countdown').style.display = 'none';
                        window.location.href = '../view/index.php'; 
                    }
                }, 1000);
            }
            </script>
            <?php
        }
    }
?>