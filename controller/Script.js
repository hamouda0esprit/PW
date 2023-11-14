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
