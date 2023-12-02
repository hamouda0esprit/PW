<?php
require("Connection.php"); 
session_start();
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
            if (password_verify($password, $storedPassword)) {
                if($row['status'] == 0){
                    $_SESSION['email'] = $email;
                    header("Location: ../view/Verification.php");
                    exit();
                }else{
                    header("Location: ../view/Management.php");
                    exit();
                }
            } else {
                
                echo "Password do not match";
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
