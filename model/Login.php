<?php
require("Connection.php"); 

$bd = new Connection();
$pdo = $bd::getConnexion();
$email = $_POST['email'];
$password = $_POST['password']; 

try {
    $query = "SELECT * FROM data WHERE email = '$email'";
    $result = $pdo->query($query);

    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $storedPassword = $row['password'];
            // Perform your comparison here
            if ($password === $storedPassword) {
                header("Location: ../view/Management.php");
                exit();
            } else {
                echo "Password do not match";
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
        } else {
            echo "Email do not match";
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
        }else {
            echo "Request failed";
        exit();
    
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
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
