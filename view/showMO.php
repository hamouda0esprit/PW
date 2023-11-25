<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\controller\getManageOrdersLivreur.css">
</head>
<body>
    <!-- <?php  
        // require_once("../controller/navbar.php"); 
        // navbar();
    ?>
    <h2>Manage Orders</h2>

    <?php  
        // require_once("..\controller\manageOrders.php");
        // showManageOrders();
    ?> -->

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

</body>
</html>