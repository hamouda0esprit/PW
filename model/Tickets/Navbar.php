<html>
    <head>
        <link rel="stylesheet" href="../../model/Tickets/Navbar.css">
        <script src="../../model/Tickets/Navbar.js"></script>
    </head>

    <body>
        <?php
            $userID = "A49sqd48qs9df4";
            function navbar(){
                global $userID;
                if ($userID[0] == "L"){
        ?>

            <div class="navbar">
                <div class="left">
                    <a href="../../view/Tickets/index.php"><img src="../../Assets/Navbar/Logo.png" class="Logo-Img"></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../../view/Tickets/index.php" class="hyperlinks"> Home </a>
                        <a href="#" class="hyperlinks"> Active Deliveries </a>
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
            }elseif ($userID[0] == "C"){
        ?>

            <div class="navbar">
                <div class="left">
                    <a href="../../view/Tickets/index.php"><img src="../../Assets/Navbar/Logo.png" class="Logo-Img" alt=""></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../../view/Tickets/index.php" class="hyperlinks"> Home </a>
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
                    <a href="../../view/Tickets/index.php"><img src="../../Assets/Navbar/Logo.png" class="Logo-Img"></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../../view/Tickets/index.php" class="hyperlinks"> Home </a>
                        <a href="#" class="hyperlinks" id="dashboard-link"> Dashboard </a>
                        <ul class="dropdown" id="dashboard-dropdown">
                            <li class="dd"><a href="#" class="hyperlinks-dd">Users</a></li>
                            <li class="dd"><a href="#" class="hyperlinks-dd">Bids</a></li>
                            <li class="dd"><a href="#" class="hyperlinks-dd">Deliveries</a></li>
                            <li class="dd"><a href="../../view/Tickets/Ticket Request - Admin.php" class="hyperlinks-dd">Tickets</a></li>
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
                    <a href="../../view/Tickets/index.php"><img src="../../Assets/Navbar/Logo.png" class="Logo-Img"></a>
                </div>
                <div class="right">
                    <div class="right-left">
                        <a href="../../view/Tickets/index.php" class="hyperlinks"> Home </a>
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