<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'><link rel="stylesheet" href="./verif.css">
    <title>Verification</title>
</head>
<body>
    <?php 
    require("../model/Connection.php");
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    //generate code
    function generateCode($length) {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    $code = generateCode(4);
    $_SESSION['code'] = $code;
    $email =$_SESSION['email'];
    $subject = 'Email verification';
    $message = $code;
    //ne5et el name 
    $query = "SELECT * FROM data WHERE email = '$email'";
    $result = $pdo->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $nom = $row['nom'];
    //nebath el mail
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'eternaluniondelievery@gmail.com';
    $mail->Password = 'anqvbwngrcbbqfsn';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($email, $nom);
    $mail->addAddress($email);
    $mail->Subject = ("DeleveryLink ($subject)");
    $mail->Body = $message;
    $mail->send();

    ?>
<form action="../model/procces.php" method="POST">
  <h4 class="text-center mb-4">Enter your code</h4>
  <div class="d-flex mb-3">
    <input type="tel" maxlength="1" pattern="[0-9]" class="form-control" name="digit1">
    <input type="tel" maxlength="1" pattern="[0-9]" class="form-control" name="digit2">
    <input type="tel" maxlength="1" pattern="[0-9]" class="form-control" name="digit3">
    <input type="tel" maxlength="1" pattern="[0-9]" class="form-control" name="digit4">
  </div>
  <button type="submit" class="w-100 btn btn-primary">Verify account</button>
  <script  src="../controller/Js/verifcation.js"></script>
</form>
</body>
</html>