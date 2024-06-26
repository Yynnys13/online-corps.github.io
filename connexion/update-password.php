<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Connexion à la base de données
    $conn = new mysqli('host', 'username', 'password', 'database');

    // Vérifiez si le jeton est valide
    $result = $conn->query("SELECT * FROM users WHERE reset_token='$token' AND reset_token_expiry > NOW()");
    if ($result->num_rows > 0) {
        $conn->query("UPDATE users SET password='$newPassword', reset_token=NULL, reset_token_expiry=NULL WHERE reset_token='$token'");
        echo "Votre mot de passe a été mis à jour avec succès.";
    } else {
        echo "Le lien de réinitialisation est invalide ou a expiré.";
    }
}
?>
