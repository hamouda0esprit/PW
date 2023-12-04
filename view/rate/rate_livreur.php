<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Livreur</title>
    <link rel="stylesheet" type="text/css" href="rate.css">
</head>
<body>
    <?php 
    $id_client = $_POST["clientId"];
    $id_livreur= $_POST["idLivreur"];
    $type= $_POST["type"];
    ?>
    <h1>Rate Livreur</h1>
    <form action="process_rating.php" method="post">
        <label for="stars">Stars:</label>
        <input type="number" name="stars" min="1" max="5" required>
        
        <label for="comment">Comment:</label>
        <textarea name="comment" rows="4" cols="50" maxlength="255" required></textarea>
    
        <input type="hidden" name="clientId" value="<?php echo $id_client; ?>">
        <input type="hidden" name="idLivreur" value="<?php echo $id_livreur; ?>">
        <input type="hidden" name="type" value="<?php echo $type; ?>">


        <!-- Add other hidden fields as needed -->
        
        <button type="submit">Submit Rating</button>
    </form>
</body>
</html>
