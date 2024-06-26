<?php
session_start();
include 'config.php';

// Vérifiez si le site est en mode maintenance
if ($maintenance_mode) {
    // Si l'utilisateur est connecté et est un administrateur, ne pas rediriger
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'admin2')) {
        // Laissez les administrateurs accéder au site normalement
    } else {
        // Redirigez les autres utilisateurs vers la page de maintenance
        header('Location: maintenance.php');
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

// Si le formulaire est soumis pour la mise à jour du profil
if(isset($_POST['submit'])) {
    // Mettre à jour les informations du profil
    $users[$username]['firstName'] = $_POST['firstName'];
    $users[$username]['lastName'] = $_POST['lastName'];
    $users[$username]['companyName'] = $_POST['companyName'];
    $users[$username]['email'] = $_POST['email'];
    $users[$username]['password'] = $_POST['password']; // Mettre à jour le mot de passe

    // Sauvegarder les données mises à jour
    file_put_contents('../../admin/users_data.php', '<?php $users = ' . var_export($users, true) . '; ?>');

    // Rediriger vers la page de profil
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil</title>
    <link rel="stylesheet" href="../../cursor.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
        }
        .form-group input {
            width: calc(100% - 30px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .show-password-btn {
        display: inline-block;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-left: 3px;
        margin-top: 5px;
      	}
        .show-password-btn:hover {
            background-color: #0056b3;
        }
      
        .back-btn {
        position: absolute;
        top: 10px;
        left: 30px;
        font-size: 48px;
        cursor: pointer;
        color: #007bff;
        text-decoration: none;
      	}
    </style>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Modifier le Profil</h1>
      	<a href="javascript:history.go(-1)" class="back-btn pointer">&#8592;</a>
        <form method="post" action="">
            <div class="form-group">
                <label>Nom:</label>
                <input class="text" type="text" name="firstName" value="<?php echo $userInfo['firstName']; ?>">
            </div>
            <div class="form-group">
                <label>Prénom:</label>
                <input class="text" type="text" name="lastName" value="<?php echo $userInfo['lastName']; ?>">
            </div>
            <div class="form-group">
                <label>Nom de company:</label>
                <input class="text" type="text" name="companyName" value="<?php echo $userInfo['companyName']; ?>">
            </div>
            <div class="form-group">
                <label>Mail:</label>
                <input class="text" type="text" name="email" value="<?php echo $userInfo['email']; ?>">
            </div>
            <div class="form-group">
                <label>Mot de passe:</label>
                <input class="text" type="password" id="password" name="password" value="<?php echo $userInfo['password']; ?>">
                <button type="button" class="show-password-btn pointer" onclick="togglePassword()">Afficher</button>
            </div>
            <div class="form-group">
                <input class="pointer" type="submit" name="submit" value="Enregistrer">
            </div>
        </form>
    </div>
</body>
</html>
