<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign up</title>
    <link rel="stylesheet" href="Style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    
    <form action="../model/Update password.php" method="POST" onsubmit="return validatemdp();">
    <section class="Container">
        <div class="Login">
            <div class="Content">
                <header>Reset Password</header>
                <form action="../model/Update password.php" method="POST" >
                    <div class="Field">
                        <input id="email" type="text" placeholder="Email" class="input" name="email">
                    </div>
                    <div class="Field">
                        <input type="password" placeholder="New Password" class="password" name="newPassword" id="newPassword"">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="Link">
                        <a href="index.php" class="forget-password">Log In</a>
                    </div>
                    <div class="Field">
                        <button type="submit">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Nheb norked -->
    </section>
</form> 
    <!--Javascript-->
    <script src="../controller/Js/Script.js"></script>
</body>
</html>