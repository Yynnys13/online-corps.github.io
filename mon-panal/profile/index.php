<?php
session_start();
include 'config.php';

// Vérifiez si le site est en mode maintenance
if ($maintenance_mode) {
    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
        // Si l'utilisateur est 'user', redirigez vers la page de non accès
        if ($role === 'user') {
            header('Location: https://online-corps.com/contact/no-access');
            exit;
        }
        // Si l'utilisateur est 'admin' ou 'admin2', laissez-les accéder au site
        elseif ($role === 'admin' || $role === 'admin2') {
            // Laisser passer
        }
    } else {
        // Si l'utilisateur n'est pas connecté, redirigez vers la page de connexion
        header('Location: https://online-corps.com/connexion');
        exit;
    }
}

// Chargement des données des utilisateurs
include('../../admin/users_data.php');

// Vérification de la session de l'utilisateur
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Récupération des informations de l'utilisateur connecté
$username = $_SESSION['username'];
$userInfo = $users[$username];

// Vérification du rôle de l'utilisateur
if ($userInfo['role'] !== 'user' && $userInfo['role'] !== 'admin' && $userInfo['role'] !== 'admin2') {
    header("Location: https://online-corps.com/connexion/");
    exit();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="../../cursor.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative; /* Permet de positionner le bouton */
        }
        h1 {
            text-align: center;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            font-weight: bold;
        }
        .profile-info span {
            margin-left: 10px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        /* Style pour le bouton de retour en haut vers la gauche */
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 30px;
            cursor: pointer;
            color: #007bff;
            text-decoration: none; /* Retire le soulignement */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Bouton de retour en haut vers la gauche -->
        <a href="https://online-corps.com/mon-panel/" class="back-btn pointer">&#8592;</a>
        <h1>Profil Utilisateur</h1>
        <div class="profile-info">
            <label>Nom d'utilisateur:</label>
            <span><?php echo $username; ?></span>
        </div>
        <div class="profile-info">
            <label>Nom:</label>
            <span><?php echo $userInfo['firstName']; ?></span>
        </div>
        <div class="profile-info">
            <label>Prénom:</label>
            <span><?php echo $userInfo['lastName']; ?></span>
        </div>
        <div class="profile-info">
            <label>Nom de company:</label>
            <span><?php echo $userInfo['companyName']; ?></span>
        </div>
        <div class="profile-info">
            <label>Mail:</label>
            <span><?php echo $userInfo['email']; ?></span>
        </div>
        <div class="profile-info">
            <label>Mot de passe:</label>
            <span>
                <input type="password" id="password" value="<?php echo $userInfo['password']; ?>" disabled>
                <button onclick="togglePasswordVisibility()">Voir</button>
            </span>
        </div>
        <div class="profile-info">
            <label>Rôle:</label>
            <span><?php echo $userInfo['role']; ?></span>
        </div>
        <a href="edit_profile.php" class="btn pointer">Modifier le Profil</a>
        <a href="../logout.php" class="btn pointer">Déconnexion</a>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var button = document.querySelector("button");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                button.textContent = "Cacher";
            } else {
                passwordInput.type = "password";
                button.textContent = "Voir";
            }
        }
    </script>
</body>
</html>
