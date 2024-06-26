<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    // Vérifiez si l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide.";
        exit();
    }

    // Connexion à la base de données
    $servername = "your_database_host";
    $username = "your_database_username";
    $password = "your_database_password";
    $dbname = "your_database_name";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Connexion à la base de données échouée: " . $conn->connect_error);
    }

    // Échapper l'email pour éviter les injections SQL
    $email = $conn->real_escape_string($email);

    // Vérifiez si l'email existe
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50)); // Générer un jeton unique
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Mettre à jour la table users avec le jeton et la date d'expiration
        $updateQuery = "UPDATE users SET reset_token='$token', reset_token_expiry='$expiry' WHERE email='$email'";
        if ($conn->query($updateQuery) === TRUE) {
            // Envoyer l'email
            $resetLink = "http://yourwebsite.com/reset-password-form.php?token=$token";
            $subject = "Réinitialisation du mot de passe";
            $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe : $resetLink";
            $headers = 'From: no-reply@yourwebsite.com' . "\r\n" .
                       'Reply-To: no-reply@yourwebsite.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

            if (mail($email, $subject, $message, $headers)) {
                echo "Un lien de réinitialisation a été envoyé à votre adresse email.";
            } else {
                echo "Erreur lors de l'envoi de l'email.";
            }
        } else {
            echo "Erreur lors de la mise à jour du jeton de réinitialisation.";
        }
    } else {
        echo "Adresse email non trouvée.";
    }

    $conn->close();
} else {
    echo "Méthode de requête non autorisée.";
}
?>
