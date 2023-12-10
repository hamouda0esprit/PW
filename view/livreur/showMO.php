<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link rel="stylesheet" href="..\..\controller\livreur\pagination\pagination.css">
    <link rel="stylesheet" href="..\..\controller\livreur\manageOrders\getManageOrdersLivreur.css">
    <link rel="stylesheet" href="../../controller/navbar/navbar.scss">
</head>
<body>
    <?php  
    	if(isset($_POST["nbpage"])){
            $act=  intval($_POST["nbpage"]);
        }else{
            $act= 1;
        }
        require_once("../../controller/navbar/navbar.php"); 
        navbar();
    ?>

    <div class="container">
        <main class="table" >
            <section class="table__header">
                <h1>Manage Orders</h1>
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
                            <th class="idSize"> id <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Customer <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Departure Location <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Arrival Location <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Date of Departure <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Arrival Date <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Amount <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Status <span class="icon-arrow">&UpArrow;</span> </th>
                            <th> Actions <span class="icon-arrow">&UpArrow;</span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once("..\..\controller\livreur\manageOrders\getManageOrdersLivreur.php");
                            getManageOrdersLivreur($act);
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
        <?php
        require_once("..\..\controller\livreur\pagination\pagination.php");
        pagination($act,"SELECT CEILING(COUNT(`idBid`)/10) as nb  FROM `colis_a_encherer` WHERE `idLivreur`='L1';");
        ?>
    </div>
   
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <!-- <script src="..\controller\pagination\pagination.js"></script> -->
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
    <script src="..\..\controller\livreur\manageOrders\getManageOrdersLivreur.js"></script>
    <script src="..\..\controller\livreur\activeDeliveries\bidFormControl.js"></script>
</body>
</html>