<?php
require("Connection.php"); 

$bd = new Connection();
$pdo = $bd::getConnexion();

$email = $_POST['email'];
$newPassword = $_POST['newPassword']; 

try {
    $query = $pdo->prepare("SELECT * FROM data WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $result = $query->fetchAll();

    if (count($result) > 0) {
        // Email exists in the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE data SET password = :hashedPassword WHERE email = :email";
        
        $updateQuery = $pdo->prepare($updatePasswordQuery);
        $updateQuery->bindParam(':hashedPassword', $hashedPassword);
        $updateQuery->bindParam(':email', $email);
        
        if ($updateQuery->execute()) {
            echo "Password updated successfully!";
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
                        window.location.href = '../view/Home.php'; 
                    }
                }, 1000); // Update every 1 second (1000 milliseconds)
            }
            </script>
            <?php
        } else {
            echo "Error updating password.";
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
                        window.location.href = '../view/Home.php'; 
                    }
                }, 1000); // Update every 1 second (1000 milliseconds)
            }
            </script>
            <?php
        }
    } else {
        echo "Email does not exist!";
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
                        window.location.href = '../view/Home.php'; 
                    }
                }, 1000);
            }
            </script>
            <?php
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>