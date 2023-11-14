<?php
require("Connection.php"); 

$bd = new Connection();
$pdo = $bd::getConnexion();
$email = $_POST['email'];
$password = $_POST['password']; 
$newPassword = $_POST['newPassword']; 
try {
    $query = $pdo->prepare("SELECT * FROM data WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $result = $query->fetchAll();

    if (count($result) > 0) {
        foreach ($result as $row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                $updatePasswordQuery = "UPDATE data SET password = '$newPassword' WHERE email = '$email'";
                if ($conn->query($updatePasswordQuery) === TRUE) {
                    echo "Password updated successfully!";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        }
    } else {
        echo "<script>alert('Email do not exsiste');</script>";
    }
    
    exit();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
