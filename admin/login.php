<?php
session_start();
include 'users_data.php'; // Assurez-vous que le chemin d'accès est correct

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (isset($users[$username]) && $users[$username]['password'] == $password) {
    // Authentification réussie
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $users[$username]['role'];
    echo json_encode(['success' => true, 'message' => "Bienvenue $username!"]);
} else {
    // Échec de l'authentification
    echo json_encode(['success' => false, 'message' => 'Nom d’utilisateur ou mot de passe incorrect.']);
}