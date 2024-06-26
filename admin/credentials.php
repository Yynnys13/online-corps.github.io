<?php
session_start(); // Démarrer la session PHP au début du fichier.

include 'users_data.php'; // Inclure le fichier contenant le tableau des utilisateurs.

function updateCredentialsFile($users) {
    $export = var_export($users, true);
    $data = "<?php\n\$users = $export;\n?>";
    file_put_contents('users_data.php', $data); // Mettre à jour le fichier users_data.php.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? ''; // Nouveau mot de passe ou celui pour authentification.
    $role = $_POST['role'] ?? ''; // Pour la mise à jour du rôle par l'admin.

    // Traitement des actions sans nécessiter d'authentification directe.
    switch ($action) {
        case 'login':
            if (isset($users[$username]) && $users[$username]['password'] == $password) {
                // Authentification réussie.
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $users[$username]['role'];
                echo json_encode(['success' => true, 'message' => "Bienvenue $username!"]);
            } else {
                // Échec de l'authentification.
                echo json_encode(['success' => false, 'message' => 'Nom d’utilisateur ou mot de passe incorrect.']);
            }
            break;

		case 'removeUser':
    if ($_SESSION['loggedin'] && $_SESSION['role'] === 'admin') {
        // Assurez-vous que seul un administrateur peut supprimer un utilisateur.
        if (isset($users[$username])) {
            unset($users[$username]); // Supprime l'utilisateur du tableau.
            updateCredentialsFile($users); // Met à jour le fichier avec le tableau modifié.
            echo json_encode(['success' => true, 'message' => "L'utilisateur $username a été supprimé avec succès."]);
        } else {
            echo json_encode(['success' => false, 'message' => "L'utilisateur n'existe pas."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Opération non autorisée."]);
    }
    break;

        case 'changePassword':
    // Vérifie si l'utilisateur connecté est celui dont le mot de passe doit être changé OU si c'est un admin
    if ($_SESSION['loggedin'] && ($_SESSION['username'] === $username || $_SESSION['role'] === 'admin')) {
        // Permet à l'utilisateur de changer son propre mot de passe OU à l'admin de changer celui de n'importe quel utilisateur
        $users[$username]['password'] = $password;
        updateCredentialsFile($users);
        echo json_encode(['success' => true, 'message' => "Mot de passe modifié pour $username."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Opération non autorisée."]);
    }
    break;


		case 'generateRandomPassword':
    if ($_SESSION['loggedin'] && $_SESSION['role'] === 'admin') {
        // Génère un mot de passe aléatoire pour l'utilisateur
        $newPassword = bin2hex(random_bytes(8)); // Génère un mot de passe aléatoire
        $users[$username]['password'] = $newPassword; // Assigne le nouveau mot de passe
        updateCredentialsFile($users); // Met à jour le fichier
        echo json_encode(['success' => true, 'message' => "Mot de passe réinitialisé avec succès pour $username.", 'password' => $newPassword]);
    } else {
        echo json_encode(['success' => false, 'message' => "Opération non autorisée."]);
    }
    break;

        case 'selfRemoveUser':
            if ($_SESSION['loggedin'] && $_SESSION['username'] === $username) {
                // Permet à l'utilisateur de supprimer son propre compte.
                unset($users[$username]);
                updateCredentialsFile($users);
                session_destroy(); // Termine la session.
                echo json_encode(['success' => true, 'message' => "Votre compte a été supprimé avec succès."]);
            } else {
                echo json_encode(['success' => false, 'message' => "Opération non autorisée."]);
            }
            break;

        case 'changeUserRole':
            if ($_SESSION['loggedin'] && $_SESSION['role'] === 'admin' && isset($users[$username])) {
                // Permet à l'admin de changer le rôle d'un utilisateur.
                $users[$username]['role'] = $role;
                updateCredentialsFile($users);
                echo json_encode(['success' => true, 'message' => "Le rôle de l'utilisateur $username a été modifié en $role."]);
            } else {
                echo json_encode(['success' => false, 'message' => "Opération non autorisée ou l'utilisateur n'existe pas."]);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => "Action non reconnue."]);
            break;
    }

    exit();
}
?>
