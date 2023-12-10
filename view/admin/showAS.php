<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Statistics</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link rel="stylesheet" href="../../controller/admin/statistics/distribution.css">
    <link rel="stylesheet" href="../../controller/admin/statistics/statistics.css">
    <link rel="stylesheet" href="..\..\controller\navbar\navbar.scss">
</head>
<body>
    <?php
        require_once("..\..\controller/navbar/navbar.php"); 
        navbar();
    ?>
    <div class="statisticsContainer">
        <div class="firstZone">
            <div>
                <?php
                    require_once("../../controller/admin/statistics/distribution.php"); 
                    distribution();
                ?>
            </div>
            <div>
                <?php
                    require_once("../../controller/admin/statistics/usage.php"); 
                    usage();
                ?>
            </div>
        </div>
        <div class="secondZone">
            <div>
            <?php
                require_once("../../controller/admin/statistics/chf_aff.php"); 
                chf_aff();
            ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../controller/admin/statistics/distribution.js"></script>
    <script src="../../controller/admin/statistics/usage.js"></script>
    <script src="../../controller/admin/statistics/chf_aff.js"></script>
</body>
</html>