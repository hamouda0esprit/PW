
//aaaaaaaaaaaa123
<?php
require("Connection.php");
    function generateRandomString($length) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return 'C' . $randomString;
    }
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $ID = generateRandomString(8);
    // Handle image upload
    $targetDirectory = "../view/uploads/"; // Directory where images will be stored
    $imageFileName = basename($_FILES["image_url"]["name"]); // Get the name of the image file
    $targetFilePath = $targetDirectory . $imageFileName; // Path to store the uploaded image

    // Upload the image file
    if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $targetFilePath)) {
        // Database connection (replace with your database connection code)
        $pdo = Connection::getConnexion();
        // Insert data into the database
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
                        document.getElementById('countdown').style.display = 'none'; // Hide the countdown
                        window.location.href = '../view/index.php'; 
                    }
                }, 1000); // Update every 1 second (1000 milliseconds)
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
