<?php
    function usage(){
?>
    <div class="usageData" style="display:none">
<?php
        require_once("..\..\model\config.php"); 
        $bd = new config();
        $pdo = $bd::getConnexion();
        try{
            // Sélectionner le nombre de clients
            $query = $pdo->prepare("SELECT
                all_dates.date,
                COUNT(colis_a_encherer.dateDepart) AS nombre_utilisations
                FROM
                    (
                        SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as date
                        FROM
                            (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a
                            CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
                            CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) c
                    ) all_dates
                    LEFT JOIN colis_a_encherer ON all_dates.date = colis_a_encherer.dateDepart
                    WHERE all_dates.date >= CURDATE() - INTERVAL 30 DAY
                    GROUP BY all_dates.date
                    ORDER BY all_dates.date;
            ");
            $query->execute();
            $result = $query->fetchAll();
?>
<?php
        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){

            ?>
        <p class="date"><?php echo $row["date"] ?></p>
        <p class="nbu"><?php echo $row["nombre_utilisations"] ?></p>
            <?php
        }
?>
    </div>
        <canvas id="usageCanvas" aria-lable="chart" role="img"></canvas>
<?php
    }
?>