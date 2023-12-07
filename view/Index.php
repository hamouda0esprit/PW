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
    <?php 
    require_once '../vendor/autoload.php';
    $clientID = '661837775057-h6a0s2kc0h15338salccf63e1k018m27.apps.googleusercontent.com';
    $clientSecret='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';
    $redirecturi='http://localhost/PW/view/index.php';

    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirecturi);
    $client->addScope('profile');
    $client->addScope('email');
    $client->addScope('https://www.googleapis.com/auth/user.phonenumbers.read');

    if(isset($_GET['code'])){
        $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);
        $gauth = new Google_Service_Oauth2($client);
        $google_info = $gauth->userinfo->get();
        $email = $google_info->email;
        ?>
        <form action="../model/Login.php" method="POST" onsubmit="return validateemail()">
            <section class="Container">
                <div class="Login">
                    <div class="Content">
                        <header>Login</header>
                        <form action="#">
                            <div class="Field">
                                <input id="email" type="text" placeholder="Email" class="input" name="email" value="<?php echo$email;?>">
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
                        <a href="<?php echo $client->createAuthUrl();?>" class="GG">
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
        <?php
    }else{
        ?>
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
                        <a href="<?php echo $client->createAuthUrl();?>" class="GG">
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
        <?php
    }
    ?>
    
</body>
</html>