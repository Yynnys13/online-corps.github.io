<?php
session_start();

// Chemin vers le fichier `users_data.php`
$usersDataFile = '../admin/users_data.php'; // Assurez-vous que le chemin est correct

// Vérifier si les champs ne sont pas vides
if (empty($_POST['username']) || empty($_POST['password'])) {
    // Rediriger vers la page d'inscription avec un message d'erreur
    header('Location: inscription.php?error=emptyfields');
    exit;
}

$username = $_POST['username'];
$password = $_POST['password']; // Stockage du mot de passe en texte clair
$firstName = ($_POST['firstName']);
$lastName = ($_POST['lastName']);
$companyName = ($_POST['companyName']);
$email = ($_POST['email']);

// Inclure le fichier des données utilisateurs
include $usersDataFile;

// Vérifier si le nom d'utilisateur existe déjà
if (isset($users[$username])) {
    // Rediriger vers la page d'inscription avec un message d'erreur
    header('Location: inscription.php?error=usernameexists');
    exit;
}

// Ajout du nouvel utilisateur
$users[$username] = ['firstName' => $firstName, 'lastName' => $lastName, 'companyName' => $companyName, 'email' => $email, 'password' => $password, 'role' => 'user'];

// Mettre à jour le fichier users_data.php
updateCredentialsFile($users);

// Rediriger vers la page de connexion avec un message de réussite
header('Location: /connexion');
exit;

function updateCredentialsFile($users) {
    $export = var_export($users, true);
    $data = "<?php\n\$users = $export;\n?>";
    file_put_contents('../admin/users_data.php', $data);
}
?>