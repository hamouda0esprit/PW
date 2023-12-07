<?php
function chf_aff(){
?>
    <div class="chf_affData" style="display:none">
        <?php
            require_once("..\model\config.php"); 
            $bd = new config();
            $pdo = $bd::getConnexion();
            $oldcollected=0;
            $oldgiven=0;
            $olddiff=0;
            try {
                // Sélectionner le nombre de clients
                $query = $pdo->prepare("
                    SELECT
                        all_dates.date,
                        COALESCE(COUNT(colis_a_encherer.idBid), 0) AS nombre_utilisations,
                        COALESCE(SUM(colis_a_encherer.montant), 0) AS total_montant,
                        COALESCE(SUM(colis_a_encherer.montant * 0.8), 0) AS amount_times_0_8,
                        COALESCE(SUM(colis_a_encherer.montant), 0) - COALESCE(SUM(colis_a_encherer.montant * 0.8), 0) AS difference
                    FROM
                        (
                            SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as date
                            FROM
                                (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a
                                CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
                                CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) c
                        ) all_dates
                    LEFT JOIN colis_a_encherer ON DATE(all_dates.date) = DATE(colis_a_encherer.dateDepart) AND colis_a_encherer.status >= 1
                    WHERE all_dates.date >= CURDATE() - INTERVAL 30 DAY
                    GROUP BY all_dates.date
                    ORDER BY all_dates.date;
                ");
                $query->execute();
                $result = $query->fetchAll();
        ?>
        <?php
            } catch(PDOException $e) {
                echo "connection failed :". $e->getMessage();
            }
            foreach($result as $row) {
                $oldcollected=$oldcollected + floatval($row["total_montant"]);
                $oldgiven=$oldgiven + floatval($row["amount_times_0_8"]);
                $olddiff=$olddiff + floatval($row["difference"]);
        ?>
            <p class="cdate"><?php echo $row["date"] ?></p>
            <p class="collected"><?php echo $oldcollected ?></p>
            <p class="given">-<?php echo $oldgiven ?></p>
            <p class="diff"><?php echo $olddiff ?></p>
        <?php
            }
        ?>
    </div>
    <canvas id="chf_affCanvas" aria-label="chart" role="img" ></canvas>
<?php
}
?>