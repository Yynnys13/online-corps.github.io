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

// Vérifier si le nom d'utilisateur est passé en paramètre
if(isset($_GET['username'])) {
    $username = $_GET['username'];

    // Vérifier si l'utilisateur existe dans la liste
    if(isset($users[$username])) {
        $user = $users[$username];
    } else {
        echo "Utilisateur non trouvé.";
        exit;
    }
} else {
    echo "Paramètre manquant : username";
    exit;
}

// Si le formulaire est soumis pour la mise à jour de l'utilisateur
if(isset($_POST['submit'])) {
    // Mettre à jour les données de l'utilisateur
    $newUsername = $_POST['username'];
    $users[$newUsername] = $users[$username]; // Copier les données existantes
    unset($users[$username]); // Supprimer l'ancien nom d'utilisateur
    $users[$newUsername]['firstName'] = $_POST['firstName'];
    $users[$newUsername]['lastName'] = $_POST['lastName'];
    $users[$newUsername]['companyName'] = $_POST['companyName'];
    $users[$newUsername]['email'] = $_POST['email'];
    
    // Vérifier si un nouveau mot de passe est saisi
    if (!empty($_POST['password'])) {
        $users[$newUsername]['password'] = $_POST['password'];
    } else {
        // Conserver l'ancien mot de passe si le champ "Nouveau mot de passe" est vide
        $users[$newUsername]['password'] = $user['password'];
    }
    
    $users[$newUsername]['role'] = $_POST['role'];

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
    <title>Modifier l'utilisateur</title>
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

<h1>Modifier l'utilisateur</h1>

<form method="post" action="">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="username" value="<?php echo $username; ?>"><br>
    <label>Nom:</label>
    <input type="text" name="firstName" value="<?php echo $user['firstName']; ?>"><br>
    <label>Prénom:</label>
    <input type="text" name="lastName" value="<?php echo $user['lastName']; ?>"><br>
    <label>Nom de company:</label>
    <input type="text" name="companyName" value="<?php echo $user['companyName']; ?>"><br>
    <label>Mail:</label>
    <input type="text" name="email" value="<?php echo $user['email']; ?>"><br>
    <label>Mot de passe actuel:</label>
    <input type="text" name="current_password" value="<?php echo $user['password']; ?>" readonly><br>
    <label>Nouveau mot de passe:</label>
    <input type="password" name="password" value=""><br>
    <label>Rôle utilisateur:</label>
    <select name="role">
        <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>Utilisateur</option>
        <?php
        // Vérifier si l'utilisateur connecté a le rôle "admin2"
        if ($_SESSION['role'] == 'admin2') {
            echo "<option value='admin' ".($user['role'] == 'admin2' ? 'selected' : '').">Administrateur</option>";
          	echo "<option value='admin2' ".($user['role'] == 'admin2' ? 'selected' : '').">Directeur</option>";
        }
        ?>
    </select><br>
    <input type="submit" name="submit" value="Enregistrer">
</form>

</body>
</html>
