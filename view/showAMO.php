<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../controller/navbar/navbar.scss">
    <style>
        h2{
            padding:30px;
        }
    </style>
</head>
<body>
    <?php  
        require_once("../controller/navbar/navbar.php"); 
        navbar();
    ?>
    <h2>Admin Manage Orders</h2>

    <?php  
        require_once("..\controller\AdminManageOrders.php");
        showAdminManageOrders();
    ?>
</body>
</html>