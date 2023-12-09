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
        <!-- Nheb norked -->
        <?php 
       require_once '../vendor/autoload.php';
       session_start();

    // facebook
        $fb = new Facebook\Facebook([
            'app_id' => '327102486769135',
            'app_secret' => '380402fccaa88b39dbf6b63d6fc0c446',
            'default_graph_version' => 'v12.0', 
        ]);

        // Facebook Login URL
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; 
        $loginUrl = $helper->getLoginUrl('http://localhost/PW/view/fb-callback.php', $permissions);

       $clientID = '661837775057-h6a0s2kc0h15338salccf63e1k018m27.apps.googleusercontent.com';
       $clientSecret='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';
       $redirecturi='http://localhost/PW/view/index2.php';
        //Google
       $client = new Google_Client();
       $client->setClientId($clientID);
       $client->setClientSecret($clientSecret);
       $client->setRedirectUri($redirecturi);
       $client->addScope('profile');
       $client->addScope('email');
        //Google
       if(isset($_GET['code'])){
           $token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
           $client->setAccessToken($token);
           $gauth = new Google_Service_Oauth2($client);
           $google_info = $gauth->userinfo->get();
           $email = $google_info->email;
           $name = $google_info->name;
            ?>
            <form onsubmit="return validateForm()" action="../model/Send.php" method="POST" enctype="multipart/form-data">
            <section class="Container">
                <div class="Login">
                    <div class="Content">
                        <header>Sign Up</header>
                        <form action="#">
                            <div class="Field">
                                <input id="nom" type="text" placeholder="Nom" class="input" name="nom" value="<?php echo$name;?>">
                            </div>
                            <div class="Field">
                                <input id="prenom" type="text" placeholder="Prénom" class="input" name="prenom">
                            </div>
                            <div class="Field">
                                <input id="numero" type="text" placeholder="Numero" class="input" name="numero">
                            </div>
                            <div class="Field">
                                <input id="email" type="text" placeholder="Email" class="input"name="email" value="<?php echo$email;?>">
                            </div>
                            <div class="Field">
                                <input id="password" type="password" placeholder="Password" class="password" name="password">
                                <i class='bx bx-hide eye-icon'></i>
                            </div>
                            <div class="Field">
                                <input id="confirmPassword" type="password" placeholder="Confirm password" class="password">
                                <i class='bx bx-hide eye-icon'></i>
                            </div>
                            <div class="Field"><input type="file" name="image_url" required></div>
                            <div class="Field">
                                <button type="submit">Sign In</button>
                            </div>
                            <div class="Link">
                                <span>You already have an account? <a href="Index.php" class="SignUpL">Log In</a></span>
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
                </section>
            </form>
    <!--Javascript-->
    <script src="../controller/Js/Script.js"></script>
            <?php
        }elseif (isset($_SESSION['fb_access_token'])){
            $userName = $_SESSION['userName'] ;
            $userEmail = $_SESSION['userEmail']; 
            ?>
            <form onsubmit="return validateForm()" action="../model/Send.php" method="POST" enctype="multipart/form-data">
            <section class="Container">
                <div class="Login">
                    <div class="Content">
                        <header>Sign Up</header>
                        <form action="#">
                            <div class="Field">
                                <input id="nom" type="text" placeholder="Nom" class="input" name="nom" value="<?php echo$userName;?>">
                            </div>
                            <div class="Field">
                                <input id="prenom" type="text" placeholder="Prénom" class="input" name="prenom">
                            </div>
                            <div class="Field">
                                <input id="numero" type="text" placeholder="Numero" class="input" name="numero">
                            </div>
                            <div class="Field">
                                <input id="email" type="text" placeholder="Email" class="input"name="email" value="<?php echo$userEmail;?>">
                            </div>
                            <div class="Field">
                                <input id="password" type="password" placeholder="Password" class="password" name="password">
                                <i class='bx bx-hide eye-icon'></i>
                            </div>
                            <div class="Field">
                                <input id="confirmPassword" type="password" placeholder="Confirm password" class="password">
                                <i class='bx bx-hide eye-icon'></i>
                            </div>
                            <div class="Field"><input type="file" name="image_url" required></div>
                            <div class="Field">
                                <button type="submit">Sign In</button>
                            </div>
                            <div class="Link">
                                <span>You already have an account? <a href="Index.php" class="SignUpL">Log In</a></span>
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
                </section>
            </form>
            <!--Javascript-->
            <script src="../controller/Js/Script.js"></script>
            <?php
        }else{
        ?>
        <form onsubmit="return validateForm()" action="../model/Send.php" method="POST" enctype="multipart/form-data">
        <section class="Container">
        <div class="Login">
            <div class="Content">
                <header>Sign Up</header>
                <form action="#">
                    <div class="Field">
                        <input id="nom" type="text" placeholder="Nom" class="input" name="nom">
                    </div>
                    <div class="Field">
                        <input id="prenom" type="text" placeholder="Prénom" class="input" name="prenom">
                    </div>
                    <div class="Field">
                        <input id="numero" type="text" placeholder="Numero" class="input" name="numero">
                    </div>
                    <div class="Field">
                        <input id="email" type="text" placeholder="Email" class="input"name="email" >
                    </div>
                    <div class="Field">
                        <input id="password" type="password" placeholder="Password" class="password" name="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="Field">
                        <input id="confirmPassword" type="password" placeholder="Confirm password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="Field"><input type="file" name="image_url" required></div>
                    <div class="Field">
                        <button type="submit">Sign In</button>
                    </div>
                    <div class="Link">
                        <span>You already have an account? <a href="Index.php" class="SignUpL">Log In</a></span>
                    </div>
                </form>
            </div>
            <div class="line"></div>
            <div class="media">
                <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="FB">
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
        
    </section>
</form>
    <!--Javascript-->
    <script src="../controller/Js/Script.js"></script>
    <?php
    }
    ?>
</body>
</html>