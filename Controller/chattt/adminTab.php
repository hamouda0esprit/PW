<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin space</title>

    <link rel="icon" type="image/x-icon" href="Admin.png">
   
   
   <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('back.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
            text-align: center;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }

        .btn{
    width: 6rem;
    border-radius: 2rem;
    border: 1px solid #d5d1defe;
    outline: none;
    padding: 5px 10px;
    margin: 5px 0;
    cursor: pointer;
    transition: .2s;
    background-color: #d5d1defe;
}
    </style>

</head>
<body>
    

    
    <table border="1"  >
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