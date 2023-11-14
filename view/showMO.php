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
    <h2>Manage Orders</h2>

    <?php  
        require_once("..\controller\manageOrders.php");
        showManageOrders();
    ?>
</body>
</html>