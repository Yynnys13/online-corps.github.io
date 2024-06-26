<?php
session_start();

// Vérification de la session pour s'assurer que l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: /connexion"); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté en tant qu'admin
    exit();
}

// Inclure votre fichier de configuration de base de données
require_once "config.php";

// Récupérer et afficher les utilisateurs depuis la base de données
$query = "SELECT * FROM utilisateurs";
$result = mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Corps - Gestion des Utilisateurs</title>
    <link rel="icon" href="/img/logo_transparent_flavion.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div>
        <br>
    </div>
</header>

<nav class="navbar">
    <div class="nav-links">
        <ul>
            <a class="text-l">Online Corps - Espace Admin</a>
            <li><a class="active" href="/">Accueil</a></li>
            <li><a href="http://food-anime.online-corps.fr">Food-Anime</a></li>
            <li><a href="/connexion">Espace client</a></li>
            <li><a href="logout.php">Se déconnecter</a></li>
        </ul>
    </div>
    <img src="../img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
</nav>

<div class="welcome-message">
    <h1>Vous êtes sur votre espace Admin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Pour vous déconnecter, cliquez-ici: <button onclick="event.preventDefault(); location.href='logout.php';" class="button-17">Se déconnecter</button></p>
</div>

<div class="gestion-utilisateurs">
    <h2>Gestion des Utilisateurs</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><a href='modifier_utilisateur.php?id=" . $row['id'] . "'>Modifier</a> | <a href='supprimer_utilisateur.php?id=" . $row['id'] . "'>Supprimer</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<footer>
    <p>&copy; 2024 <a style="color: black;" href="/">online-corps.fr</a>. Tous droits réservés.</p>
</footer>

<script>
    const menuHamburger = document.querySelector(".menu-hamburger");
    const navLinks = document.querySelector(".nav-links");

    menuHamburger.addEventListener('click', () => {
        navLinks.classList.toggle('mobile-menu');
    });
</script>

</body>
</html>
