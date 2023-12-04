<html>
    <head>
        <link rel="stylesheet" href="../model/Navbar.scss">
        <script src="../model/Navbar.js"></script>
    </head>

    <body>
        <?php
            $userID = "L";
            function navbar(){
                global $userID;
                if ($userID[0] == "L"){
        ?>

            <div class="navbar">
                <div class="left">
                    <a href="../view/index.php"><img src="../Assets/logo.png" class="Logo-Img"></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="#" class="hyperlinks"> Home </a>
                        <a href="showAD.php" class="hyperlinks"> Active Deliveries </a>
                        <a href="showMO.php" class="hyperlinks"> Dashboard </a>
                        <a href="#" class="hyperlinks"> Account </a>
                    </div>

                    <div class="splitter"></div>

                    <div class="right-right">
                        <input type="submit" Value='Logout' class="button">
                    </div>
                </div>
            </div>

        <?php
            }elseif ($userID[0] == "C"){
        ?>

            <div class="navbar">
                <div class="left">
                    <a href="../view/index.php"><img src="../Assets/Navbar/Logo.png" class="Logo-Img" alt=""></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../view/index.php" class="hyperlinks"> Home </a>
                        <a href="#" class="hyperlinks"> Add Deliveries </a>
                        <a href="#" class="hyperlinks"> Dashboard </a>
                        <a href="#" class="hyperlinks"> Account </a>
                    </div>

                    <div class="splitter"></div>

                    <div class="right-right">
                        <input type="submit" Value='Logout' class="button">
                    </div>
                </div>
            </div>
        <?php
            }elseif ($userID[0] == "A"){
        ?>

            <div class="navbar">
                <div class="left">
                    <a href="../view/index.php"><img src="../Assets/Navbar/Logo.png" class="Logo-Img"></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../view/index.php" class="hyperlinks"> Home </a>
                        <a href="#" class="hyperlinks" id="dashboard-link"> Dashboard </a>
                        <ul class="dropdown" id="dashboard-dropdown">
                            <li class="dd"><a href="#" class="hyperlinks-dd">Users</a></li>
                            <li class="dd"><a href="#" class="hyperlinks-dd">Active Deliveries</a></li>
                            <li class="dd"><a href="#" class="hyperlinks-dd">Deliveries</a></li>
                            <li class="dd"><a href="../view/Ticket%20Request%20-%20Admin.php" class="hyperlinks-dd">Tickets</a></li>
                        </ul>
                        <a href="#" class="hyperlinks"> Account </a>
                    </div>

                    <div class="splitter"></div>

                    <div class="right-right">
                        <input type="submit" Value='Logout' class="button">
                    </div>
                </div>
            </div>

        <?php
            }else{
        ?>
            <div class="navbar">
                <div class="left">
                    <a href="../view/index.php"><img src="../Assets/Navbar/Logo.png" class="Logo-Img"></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../view/index.php" class="hyperlinks"> Home </a>
                    </div>

                    <div class="splitter"></div>

                    <div class="right-right">
                        <input type="submit" Value='SignIn      /      SignUp' class="button">
                    </div>
                </div>
            </div>
        <?php
            }
            }
        ?>
    </body>
</html>