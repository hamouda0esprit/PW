<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/x-icon" href="./Assets/logo.png">
</head>



<?php
// Index.php
require_once("Connection.php");

$bd = new Connection();
$pdo = $bd::getConnexion();
?>
<div class="chat-global">
    <div class="nav-top">
        <div class="location">
            <img src="./Assets/left-chevron.svg">
            <p>Back</p>
        </div>

        <div class="utilisateur">
            <p>Emna Makni</p>
            <p>Active Now</p>
        </div>

        <div class="logos-call">
            <img src="./Assets/phone.svg">
            <img src="./Assets/video-camera.svg">
        </div>
    </div>

    <div class="conversation">
        <div class="talk left">
            <img src="./Assets/emna.jpg">
			<?php
					try{
						$query = $pdo->prepare('SELECT msg FROM Chat LIMIT 1');
						$query->execute();
						$result = $query->fetchAll();
					}
					catch(PDOExcepion $e){
						echo "connection failed :". $e->getMessage();
					}
					foreach($result as $row){
					?>
					<p><?php echo $row["msg"]?><br></p>
<?php } ?>
        </div>
        <div class="talk right">
            <img src="./Assets/nour1.jpg">
			<?php
					try{
						$query = $pdo->prepare('SELECT msg FROM Chat LIMIT 1 OFFSET 1');
						$query->execute();
						$result = $query->fetchAll();
					}
					catch(PDOExcepion $e){
						echo "connection failed :". $e->getMessage();
					}
					foreach($result as $row){
					?>
					<p><?php echo $row["msg"]?> <br></p>
					<p id="heure"></p>
<?php } ?>
        </div>
        <div class="talk left">
            <img src="./Assets/emna.jpg">
        </div>
        <div class="talk right">
            <img src="./Assets/nour1.jpg">
        </div>
    </div>


    <form class="chat-form" action="Send.php" method="POST" onsubmit="return validate()">
        <div class="container-inputs-stuffs">
            <div class="files-logo-cont">
                <img src="./Assets/paperclip.svg">
            </div>

            <div class="group-inp">
				<input type="text" placeholder="Enter your message here" minlength="1" maxlength="1500" minwidth="100" name="msg" >
			<?php 
				
			?>
                <img src="./Assets/bx-heart.svg">
            </div>
            <button class="submit-msg-btn" type="submit">
                <img src="./Assets/send.svg">
            </button>
        </div>
	
    </form>
</div>
<script>
function afficherHeure() {
    var maintenant = new Date();
    var heure = maintenant.getHours();
    var minute = maintenant.getMinutes();
    var seconde = maintenant.getSeconds();

    // Formater les chiffres pour ajouter un zéro devant s'ils sont inférieurs à 10
    heure = (heure < 10) ? "0" + heure : heure;
    minute = (minute < 10) ? "0" + minute : minute;
    seconde = (seconde < 10) ? "0" + seconde : seconde;

    // Afficher l'heure dans l'élément avec l'ID "heure"
    document.getElementById("heure").innerHTML = heure + " " + minute + " " + seconde;
}

// Appeler la fonction pour afficher l'heure dès le chargement de la page
afficherHeure();

function validate() {
    // Récupérer la valeur du champ input avec l'id 'msg'
    var msg = document.getElementsByName('msg')[0].value;

    // Vérifier si la longueur du message est supérieure à 100 caractères
    if (msg.length > 100) {
        alert('Plus de 100 caractères.');
        return false;
    }

    // Si toutes les vérifications passent, le formulaire est valide
    alert('Formulaire valide. Soumission...');
    return true;
}
</script>



</body>
</html>