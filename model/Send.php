<?php
require("Connection.php"); 
session_start();
    function generateRandomString($length) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'C' . $randomString;
    }
    
    $ID = generateRandomString(8);

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $targetDirectory = "../view/uploads/";
    $imageFileName = basename($_FILES["image_url"]["name"]);
    $targetFilePath = $targetDirectory . $imageFileName;

    if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $targetFilePath)) {
        $pdo = Connection::getConnexion();
        $sql = "INSERT INTO data (nom, prenom, numero, email, password, image_url,ID) VALUES (:nom, :prenom, :numero, :email, :password, :image_url,:ID)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':image_url', $imageFileName);
        $stmt->bindParam(':ID', $ID);

        // Execute the query
        if ($stmt->execute()) {
            echo "Image upload successfully!";
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
        } else {
            echo "Error inserting data.";
        }
    } else {
        echo "Error uploading image.";
    }

?>
