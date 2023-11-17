<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2{
            padding:30px;
        }
    </style>
</head>
<body>
    <h2>Admin Manage Orders</h2>

    <?php  
        require_once("..\controller\AdminManageOrders.php");
        showAdminManageOrders();
    ?>
</body>
</html>