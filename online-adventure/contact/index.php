<?php
if(isset($_POST['submit'])){
    $to = "online.adventure.corps@gmail.com"; // Adresse email à laquelle envoyer le message
    $subject = "Nouveau message de ".$_POST['name']; // Sujet du message

    $message = "Nom: ".$_POST['name']."\n";
    $message .= "Email: ".$_POST['email']."\n";
    $message .= "Message: \n".$_POST['message'];

    // Envoi de l'email
    if(mail($to, $subject, $message)){
        echo '<script>alert("Votre message a été envoyé avec succès.");</script>';
    } else {
        echo '<script>alert("Erreur: Votre message n\'a pas pu être envoyé.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Adventure - Contact</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include '../header.php'; ?>
  
    <h1 class="contact-heading">Contactez-nous</h1>
    <form class="contact-form" method="post" action="">
        <label for="name">Nom:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br>
        <p style="font-size: 13px; margin-bottom: 2vh; margin-top: -2vh;">Merci de bien vérifier que touts les champs son bien rempli.</p>
        <input type="submit" name="submit" value="Envoyer" class="submit-button">
    </form>
  
    <?php include '../footer.php'; ?>
</body>
</html>
