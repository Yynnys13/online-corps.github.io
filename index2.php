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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Corps</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <a href="#" class="logo" style="width: 50px;"><img src="/img/logo_transparent.png"></a>
  <nav class="navbar">
    <div class="nav-links">
      <ul>
        <a class="text-l">Online Corps</a>
        <li><a class="active" href="/">Accueil</a></li>
        <li><a class="active" href="https://online-corps.com/contact/">Contact</a></li>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
          <li><a class="active" href="./mon_panel/index.php">Mon Espace</a></li>
          <li><a class="active" href="./mon-panel/logout.php">Se déconnecter</a></li>
        <?php else: ?>
          <li><a class="active" href="./connexion/index.php">Se connecter</a></li>
          <li><a class="active" href="./inscription/index.php">S'inscrire</a></li>
        <?php endif; ?>
      </ul>
    </div>
    <img src="./img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
  </nav>

  <header>
    <div>
      <br>
    </div>
  </header>

  <div class="download-app">
    <h2>Nos téléchargement</h2>
    <p>Téléchargez notre application Online Corps dès maintenant !!!</p>
    <a href="http://app.online-corps.com" class="download-button">Aller Voir</a>
  </div>
  
  <footer>
    <p>&copy; 2024 <a style="color: black;" href="http://online-corps.com">online-corps.com</a>. Tous droits réservés.</p>
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