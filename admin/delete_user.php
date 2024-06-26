<?php

// Charger les données des utilisateurs
include('users_data.php');

// Vérifier si le nom d'utilisateur est passé en paramètre
if(isset($_GET['username'])) {
    $username = $_GET['username'];

    // Vérifier si l'utilisateur existe dans la liste
    if(isset($users[$username])) {
        // Supprimer l'utilisateur
        unset($users[$username]);

        // Sauvegarder les données mises à jour
        file_put_contents('users_data.php', '<?php $users = ' . var_export($users, true) . '; ?>');

        // Rediriger vers la page principale de gestion des utilisateurs
        header('Location: /admin/user/index.php');
        exit;
    } else {
        echo "Utilisateur non trouvé.";
        exit;
    }
} else {
    echo "Paramètre manquant : username";
    exit;
}

?>
