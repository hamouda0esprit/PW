<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Delivery Link</title>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">
<link rel="icon" type="image/x-icon" href="./assets/logo.png">
</head>

<body>
            <?php
            require("../Model/Connection.php");
            $bd = new Connection();
            $pdo = $bd::getConnexion();
            $ID = '1'; // the login person
            if ($ID == '1') {
                $query = $pdo->prepare("
                    SELECT rc.*, l.idLivreur AS livreur_id, l.nom AS livreur_nom,
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
                                    <?php }else { ?>
                                        <span class="name"><?php echo $row['client_nom'] ?></span>
                                    <?php }?>
                                    <span class="time">2:09 PM</span>
                                    <span class="preview">I was wondering...</span>
                                </li>
                            
                        </ul>
                    </div>

                    <!-- End of relations -->
                    <!-- Start -->

                    <div class="right">
                    <?php
                    require("../Model/Connection.php");
                    $bd = new Connection();
                    $pdo = $bd::getConnexion();
                    $ID = '1'; // the login person

                    $query = $pdo->prepare("
                        SELECT mc.*, rc.idclient, rc.idlivreur
                        FROM messagechat mc
                        INNER JOIN relationchat rc ON mc.idrelationel = rc.idrelationel
                        WHERE rc.idclient = :idclient OR rc.idlivreur = :idlivreur
                        ORDER BY mc.date ASC
                    ");

                    $query->bindParam(':idclient', $ID, PDO::PARAM_INT);
                    $query->bindParam(':idlivreur', $ID, PDO::PARAM_INT);
                    $query->execute();

                    $messages = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <div class="top"><span>To: <span class="name">Dog Woofson</span></span></div>
                        <div class="chat" data-chat="<?php echo 'person' . $P;
                                                    $P = $P + 1 ?>">
                            <?php foreach($messages as $row){ ?>
                            <div class="conversation-start">
                                <span><?php echo $row['date']; ?></span>
                            </div>
                            <div class="bubble you">
                                    <?php echo $row['message']; ?>
                            </div>

                        </div>
                    </div>
                    <?php }?>
                </div>
            </div><?php }?>


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