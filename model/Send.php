

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
    $ID = generateRandomString(8);
    // Handle image upload
    $targetDirectory = "uploads/"; // Directory where images will be stored
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
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':image_url', $imageFileName);
        $stmt->bindParam(':ID', $ID);

        // Execute the query
        if ($stmt->execute()) {
            echo "Image upload successfully!";
        } else {
            echo "Error inserting data.";
        }
    } else {
        echo "Error uploading image.";
    }

?>
