<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>id report</th>
            <th>message</th>
            <th>actions</th>
        </tr>
        
        <?php

        require_once("php/getReq.php"); 
        getAdmin()
        ?>
    </table>
</body>
</html>