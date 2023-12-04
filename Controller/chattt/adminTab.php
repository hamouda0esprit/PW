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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            padding: 10px;
            border: 1px solid #ccc;
            border-bottom: 1px solid #ddd;
            color: #fff;
            text-align: center;
            opacity: 0;
            animation: fadeInLeft 1s ease forwards;
            background: linear-gradient(to right, #3498db, #2ecc71);
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
            border-bottom: 1px solid #ddd;
        }


        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }
        #charCount {
            color: #333;
            font-size: 14px;
            margin-top: 5px;
        }


        a {
            text-decoration: none;
            color: #3498db;
        }


        .btn {
            background-color: #4caf50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: .2s;
            margin: 5px 0;
            outline: none;
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
        getAdmin();
        ?>
    </table>
</body>
</html>