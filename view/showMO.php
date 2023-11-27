<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\controller\getManageOrdersLivreur.css">
</head>
<body>
    <?php  
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
                            <th> Location </th>
                            <th> Order Date </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("..\controller\getManageOrdersLivreur.php");
                            getManageOrdersLivreur();
                        ?>
                    </tbody>
                </table>
            </section>

        </main>
    </div>
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
</body>
</html>