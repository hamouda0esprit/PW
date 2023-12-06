<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../controller/navbar/navbar.scss">
    <link rel="stylesheet" href="..\controller\admin\getManageOrdersAdmin.css">
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

    <?php  
        // require_once("..\controller\AdminManageOrders.php");
        // showAdminManageOrders();
    ?>
    <div class="container">
        <main class="table" >
            <section class="table__header">
                <h1>Admin Manage Orders</h1>
                <div class="input-group">
                    <input type="search" placeholder="Search data...">
                    <img src="..\Assets\search.png" alt="">
                </div>
                <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="../Assets/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="../Assets/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="../Assets/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="../Assets/excel.png" alt=""></label>
                </div>
            </div>
            </section>
            <section class="table__body"id="customers_table">
                <table>
                    <thead>
                        <tr>
                            <th> Id Bid <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Id Request <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Id Delivery Driver <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Bid <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Date of Departure <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Arrival Date <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Comment <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Actions <span class="icon-arrow">&UpArrow;</span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("..\controller\admin\getManageOrdersAdmin.php");
                            getManageOrdersAdmin()
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <script src="..\controller\admin\getManageOrdersAdmin.js"></script>
    <script>
        function confirmdelete() {
            x = confirm("are you sure ?");
            if(x == false){
                return false
            }
        }
    </script>
</body>
</html>