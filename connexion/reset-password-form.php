<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Connexion à la base de données
    $conn = new mysqli('host', 'username', 'password', 'database');

    // Vérifiez si le jeton est valide
    $result = $conn->query("SELECT * FROM users WHERE reset_token='$token' AND reset_token_expiry > NOW()");
    if ($result->num_rows > 0) {
        echo '
        <!DOCTYPE html>
        <html lang="fr">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Online Corps - Nouveau mot de passe</title>
          <link rel="icon" href="/img/logo_transparent_flavion.png">
          <link rel="stylesheet" href="styles.css">
        </head>
        <body>
          <div class="main-content">
            <h1 class="jomolhari-regular">Nouveau mot de passe</h1>
            <form id="newPasswordForm" action="update-password.php" method="post">
              <input type="hidden" name="token" value="'.$token.'">
              <label for="password">Nouveau mot de passe:</label><br>
              <input type="password" id="password" name="password" required><br><br>
              <input type="submit" value="Mettre à jour le mot de passe" class="button-17">
            </form>
            <div id="message" class="message"></div>
          </div>
          <footer>
            <p>&copy; 2024 <a style="color: black;" href="/">online-corps.fr</a>. Tous droits réservés.</p>
          </footer>
        </body>
        </html>
        ';
    } else {
        echo "Le lien de réinitialisation est invalide ou a expiré.";
    }
}
?>
