<?php
session_start(); // Démarrer la session au début du fichier
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Corps - Réinitialisation du mot de passe</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="main-content">
    <h1 class="jomolhari-regular">Réinitialisation du mot de passe</h1>
    <form id="resetPasswordForm" action="send-reset-link.php" method="post">
      <label for="email">Adresse email:</label><br>
      <input type="email" id="email" name="email" required><br><br>
      <input type="submit" value="Envoyer le lien de réinitialisation" class="button-17">
    </form>
    <div id="message" class="message"></div>
  </div>
  <footer>
    <p>&copy; 2024 <a style="color: black;" href="/">online-corps.fr</a>. Tous droits réservés.</p>
  </footer>
</body>
</html>
