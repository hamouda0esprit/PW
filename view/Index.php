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
    
    <form action="../model/Login.php" method="POST" onsubmit="return validateemail()">
    <section class="Container">
        <div class="Login">
            <div class="Content">
                <header>Login</header>
                <form action="#">
                    <div class="Field">
                        <input id="email" type="text" placeholder="Email" class="input" name="email">
                    </div>
                    <div class="Field">
                        <input type="password" placeholder="Password" class="password" name="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    
                    <div class="Link">
                        <a href="index3.php" class="forget-password">Forgot Password?</a>
                    </div>
                    <div class="Field">
                        <button type="submit">Login</button>
                    </div>
                    <div class="Link">
                        <span>You dont have an account? <a href="index2.php" class="SignUpL">Sign Up</a></span>
                    </div>
                </form>
            </div>
            <div class="line"></div>
            <div class="media">
                <a href="#" class="FB">
                    <i class='bx bxl-facebook facebook-icon' ></i>
                    <span>Login with Facebook</span>
                </a>
            </div>

            <div class="media">
                <a href="#" class="GG">
                    <img src="../controller/Assets/Google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>
        </div>

        <!-- Nheb norked -->
    </section>
</form> 
    <!--Javascript-->
    <script src="../controller/Js/Script.js"></script>
</body>
</html>