<?php
require("Connection.php"); 

$bd = new Connection();
$pdo = $bd::getConnexion();
$email = $_POST['email'];
$password = $_POST['password']; 

try {
    $query = $pdo->prepare("SELECT * FROM data WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();
    $result = $query->fetchAll();

    if (count($result) > 0) {
        foreach ($result as $row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                echo "<script>alert('Valid Email');</script>";
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
