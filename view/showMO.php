<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\controller\pagination\pagination.css">
    <link rel="stylesheet" href="..\controller\getManageOrdersLivreur.css">
    <link rel="stylesheet" href="..\navbar.css">
</head>
<body>
    <?php  
    	if(isset($_POST["nbpage"])){
            $act=  intval($_POST["nbpage"]);
        }else{
            $act= 1;
        }
        require_once("../controller/navbar.php"); 
        navbar();
    ?>
<!-- 
    <?php  
        // require_once("..\controller\manageOrders.php");
        // showManageOrders();
    ?> -->
    <div class="container">
        <main class="table">
            <section class="table__header">
                <h1>Manage Orders</h1>
                <div class="input-group">
                    <input type="search" placeholder="Search data...">
                    <img src="..\Assets\search.png" alt="">
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> id </th>
                            <th> Customer</th>
                            <th> Departure Location </th>
                            <th> Arrival Location </th>
                            <th> Date of Departure </th>
                            <th> Arrival Date </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("..\controller\getManageOrdersLivreur.php");
                            getManageOrdersLivreur($act);
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
        <?php
        require_once("..\controller\pagination\pagination.php");
        pagination($act);
        ?>
    </div>
   
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="..\controller\pagination\pagination.js"></script>
    <script>
        function confirmdelete() {
            x = confirm("are you sure ?");
            if(x == false){
                return false
            }
        }
    </script>
    <script>
        function hideBid(x) {
    
            var bidForm = document.getElementsByClassName("bidForm")[x];
            var body = document.body;

            if (bidForm.classList.contains("hide")) {
                bidForm.classList.remove("hide");
                bidForm.style.top ='-', window.scrollY + 'px';
                body.classList.add("no-scroll"); // Disable scrolling on body
            } else {
                bidForm.classList.add("hide");
                body.classList.remove("no-scroll"); // Enable scrolling on body
            }
        }

    </script>
    <script src="..\controller\getManageOrdersLivreur.js"></script>
    <script src="..\controller\activeDeliveries\bidFormControl.js"></script>
</body>
</html>