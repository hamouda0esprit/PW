<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Packages</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link rel="stylesheet" href="..\..\controller\admin\getPackages.css">
    <link rel="stylesheet" href="..\..\controller\livreur\pagination\pagination.css">
</head>
<body>
    <?php
    if(isset($_POST["nbpage"])){
        $act=  intval($_POST["nbpage"]);
    }else{
        $act= 1;
    }
    ?>
<div class="container">
        <main class="table" >
            <section class="table__header">
                <h1>Admin Manage Packages</h1>
                <div class="input-group">
                    <input type="search" placeholder="Search data...">
                    <img src="assets\search.png" alt="">
                </div>
                <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="assets\pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="assets\json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="assets\csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="assets\excel.png" alt=""></label>
                </div>
            </div>
            </section>
            <section class="table__body"id="customers_table">
                <table>
                    <thead>
                        <tr>
                            <th class="idSize"> Id Package <span class="icon-arrow">&UpArrow;</span> </th>
                            <th class="idSize"> Name Client<span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Size <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Weight <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Departure Location <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Arrival Location <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Budget <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Images <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Actions <span class="icon-arrow">&UpArrow;</span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("..\..\controller\admin\getPackages.php");
                            getPackageAdmin($act);
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
        <?php
        require_once("..\..\controller\livreur\pagination\pagination.php");
        pagination($act,"SELECT CEILING(COUNT(`idcolis`)/10) as nb  FROM `colis`");
        ?>
    </div>


    <script src="..\..\controller\user\mytask\mytask.js"></script>
</body>
</html>