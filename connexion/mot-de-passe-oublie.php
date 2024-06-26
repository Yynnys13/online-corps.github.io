<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Inclure le fichier contenant les utilisateurs
    include 'admin/users_data.php';

    // Vérifiez que l'email existe dans votre tableau
    $userFound = false;
    foreach ($users as $username => $userData) {
        if ($userData['email'] == $email) {
            $userFound = true;
            $token = bin2hex(random_bytes(50));
            $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
            $users[$username]['reset_token'] = $token;
            $users[$username]['reset_expiry'] = $expiry;
            
            // Enregistrez le token et la date d'expiration dans le fichier
            file_put_contents('admin/users_data.php', '<?php $users = ' . var_export($users, true) . '; ?>');

            // Envoyez l'email avec le lien de réinitialisation
            $resetLink = "https://votre-site.com/connexion/reset-password.php?token=" . $token;
            $subject = "Réinitialisation de votre mot de passe";
            $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe: " . $resetLink;
            $headers = "From: no-reply@votre-site.com\r\n";
            mail($email, $subject, $message, $headers);
            
            echo "Un email avec les instructions pour réinitialiser votre mot de passe a été envoyé.";
            break;
        }
    }

    if (!$userFound) {
        echo "Aucun compte associé à cet email.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="main-content">
        <h1>Réinitialiser votre mot de passe</h1>
        <form action="mot-de-passe-oublie.php" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Envoyer" class="button-17">
        </form>
    </div>
</body>
</html>
