<?php
session_start();

// Vérifiez si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin2') {
    // Si non connecté ou non administrateur, redirigez vers la page de connexion
    header('Location: https://online-corps.com/connexion/');
    exit;
}

// Inclure le fichier de configuration
$config_file_path = '../config.php';
include $config_file_path;

// Définition de variables pour afficher l'état actuel de la maintenance
$maintenance_status = $maintenance_mode ? 'Activée' : 'Désactivée';
$maintenance_action = $maintenance_mode ? 'Désactiver' : 'Activer';

// Si le formulaire est soumis pour changer l'état de la maintenance
if (isset($_POST['maintenance_action'])) {
    // Inversez l'état de la maintenance
    $maintenance_mode = !$maintenance_mode;

    // Mettez à jour le fichier de configuration
    $config_content = '<?php $maintenance_mode = ' . ($maintenance_mode ? 'true' : 'false') . '; ?>';
    file_put_contents($config_file_path, $config_content);

    // Réactualisez la page
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Maintenance</title>
    <link rel="stylesheet" href="stylesd.css">
    <link rel="stylesheet" href="../cursor.css">
  	<style>
        /* Reset des styles par défaut */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            margin-top: 10px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

  	</style>
</head>
<body>
    <div class="container">
        <h1>Tableau de bord - Maintenance</h1>
        <p>État actuel de la maintenance : <strong><?= $maintenance_status ?></strong></p>
        <form method="post">
            <button class="pointer" type="submit" name="maintenance_action" value="toggle"><?= $maintenance_action ?> la maintenance</button>
        </form>
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success') : ?>
            <p class="success-message">Le mode maintenance a été modifié avec succès !</p>
        <?php endif; ?>
        <a class="pointer" href="../logout.php">Se déconnecter</a>
    </div>
</body>
</html>
