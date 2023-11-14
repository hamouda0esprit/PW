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
    <form onsubmit="return validateForm()" action="../model/Send.php" method="POST">
    <section class="Container">

        <!-- Nheb norked -->

        <div class="Login">
            <div class="Content">
                <header>Sign Up</header>
                <form action="#">
                    <div class="Field">
                        <input id="nom" type="text" placeholder="Nom" class="input" name="nom" >
                    </div>
                    <div class="Field">
                        <input id="prenom" type="text" placeholder="Prénom" class="input" name="prenom">
                    </div>
                    <div class="Field">
                        <input id="numero" type="text" placeholder="Numero" class="input" name="numero">
                    </div>
                    <div class="Field">
                        <input id="email" type="text" placeholder="Email" class="input"name="email">
                    </div>
                    <div class="Field">
                        <input id="password" type="password" placeholder="Password" class="password" name="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="Field">
                        <input id="confirmPassword" type="password" placeholder="Confirm password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="Field">
                        <button type="submit">Sign In</button>
                    </div>
                    <div class="Link">
                        <span>You already have an account? <a href="Index.html" class="SignUpL">Log In</a></span>
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
        
    </section>
</form>
    <!--Javascript-->
    <script src="../controller/Js/Script.js"></script>
</body>
</html>