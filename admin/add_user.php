<?php

// Charger les données des utilisateurs
include('users_data.php');

// Vérification du rôle de l'utilisateur
session_start();
if(isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    header("Location: https://online-corps.com/mon-panel/");
    exit();
} elseif (!isset($_SESSION['role'])) {
    header("Location: https://online-corps.com/connexion/");
    exit();
}

// Si le formulaire est soumis pour ajouter un nouvel utilisateur
if(isset($_POST['submit'])) {
    // Créer un nouvel utilisateur
    $newUser = array(
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'companyName' => $_POST['companyName'],
        'email' => $_POST['email'],
        'password' => $_POST['password'], // Ajouter le mot de passe
        'role' => $_POST['role']
    );

    // Ajouter le nouvel utilisateur à la liste
    $username = $_POST['username'];
    $users[$username] = $newUser;

    // Sauvegarder les données mises à jour
    file_put_contents('users_data.php', '<?php $users = ' . var_export($users, true) . '; ?>');

    // Rediriger vers la page principale de gestion des utilisateurs
    header('Location: /admin/user/index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un nouvel utilisateur</title>
    <style>
        /* Styles communs pour tous les appareils */
        body {
            font-family: 'Arial', sans-serif;
         	text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        label {
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Styles spécifiques pour les appareils mobiles */
        @media (max-width: 767px) {
            form {
                padding: 10px;
            }

            input[type="text"],
            input[type="password"],
            select {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<h1>Ajouter un nouvel utilisateur</h1>

<form method="post" action="">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="username"><br>
    <label>Nom:</label>
    <input type="text" name="firstName"><br>
    <label>Prénom:</label>
    <input type="text" name="lastName"><br>
    <label>Nom de company:</label>
    <input type="text" name="companyName"><br>
    <label>Mail:</label>
    <input type="text" name="email"><br>
    <label>Mot de passe:</label>
    <input type="password" name="password"><br>
    <label>Rôle:</label>
    <select name="role">
        <option value="user">Utilisateur</option>
        <?php
        // Vérifier si l'utilisateur a le rôle "admin2" pour afficher l'option "Administrateur"
        if ($_SESSION['role'] == 'admin2') {
            echo '<option value="admin">Administrateur</option>';
          	echo '<option value="admin2">Directeur</option>';
        }
        ?>
    </select><br>
    <input type="submit" name="submit" value="Ajouter">
</form>

</body>
</html>
