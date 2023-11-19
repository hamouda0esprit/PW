<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Direct Messaging</title>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
            <?php
            require("../Model/Connection.php");

            $ID = '1';

            $bd = new Connection();
            $pdo = $bd::getConnexion();

            if ($ID == '1') {
                $query = $pdo->prepare("
                    SELECT rc.*, l.idLivreur AS livreur_id, l.nom AS livreur_nom, l.prenom AS livreur_prenom
                    FROM relationchat rc
                    JOIN livreur l ON rc.idlivreur = l.idLivreur
                    WHERE rc.idclient = :idclient
                ");
                $query->bindParam(':idclient', $ID, PDO::PARAM_INT);
                $query->execute();
            } else {
                $query = $pdo->prepare("
                    SELECT rc.*, u.ID AS client_id, u.nom AS client_nom, u.prenom AS client_prenom
                    FROM relationchat rc
                    JOIN user u ON rc.idclient = u.ID
                    WHERE rc.idlivreur = :idlivreur
                ");

                $query->bindParam(':idlivreur', $ID, PDO::PARAM_INT);
                $query->execute();
            }

            $P = 1;
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="wrapper">
                <div class="container">
                    <div class="left">
                        <div class="top">
                            <input type="text" placeholder="Search" />
                            <a href="javascript:;" class="search"></a>
                        </div>
                        <ul class="people">
                            <?php foreach ($result as $row) { ?>
                                <li class="person" data-chat="<?php echo 'person' . $P;
                                                                $P = $P + 1 ?>">
                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/thomas.jpg" alt="" />
                                    <?php if ($ID == '1') { ?>
                                        <span class="name"><?php echo $row['livreur_nom'] ?></span>
                                    <?php }else : ?>
                                        <span class="name"><?php echo $row['client_nom'] ?></span>
                                    <?php endif; ?>
                                    <span class="time">2:09 PM</span>
                                    <span class="preview">I was wondering...</span>
                                </li>
                            <?php ?>
                        </ul>
                    </div>

                    <!-- End of relations -->
                    <!-- Start -->

                    <div class="right">
                        <div class="top"><span>To: <span class="name">Dog Woofson</span></span></div>
                        <?php
                        $bd = new Connection();
                        $pdo = $bd::getConnexion();
                        $query = $pdo->prepare("
                            SELECT *
                            FROM messagechat
                            WHERE (idclient = :idclient AND idlivreur = :idlivreur) OR (idclient = :idlivreur AND idlivreur = :idclient)
                            ORDER BY date ASC
                        ");

                        if ($ID == '1') {
                            $query->bindParam(':idclient', $row['client_id'], PDO::PARAM_INT);
                            $query->bindParam(':idlivreur', $row['livreur_id'], PDO::PARAM_INT);
                        } else {
                            $query->bindParam(':idclient', $row['client_id'], PDO::PARAM_INT);
                            $query->bindParam(':idlivreur', $row['livreur_id'], PDO::PARAM_INT);
                        }
                    
                        $query->execute();
                        $messages = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach ($messages as $row) {
                        ?>

                        <div class="chat" data-chat="<?php echo 'person' . $P;
                                                    $P = $P + 1 ?>">
                            <div class="conversation-start">
                                <span>Today, 6:48 AM</span>
                            </div>
                            <div class="bubble you">
                                <?php echo $row['message'];?>
                            </div>
                            <div class="bubble you">
                                it's me.
                            </div>
                            <div class="bubble you">
                                I was wondering...
                            </div>
                        </div>
                        <?php}}?>
                    </div>
                </div>
            </div>


                    <div class="write">
                        <a href="javascript:;" class="write-link attach"></a>
                        <input type="text" />
                        <a href="javascript:;" class="write-link smiley"></a>
                        <a href="javascript:;" class="write-link send"></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>