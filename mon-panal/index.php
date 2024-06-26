<?php
session_start();
include '../config.php';

// Vérifier si le site est en mode maintenance
if ($maintenance_mode) {
    // Si l'utilisateur est connecté et n'est pas un admin, redirigez vers logout.php
    if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'admin2')) {
        header('Location: logout.php');
        exit;
    }
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: https://online-corps.com/connexion/");
    exit; // Assure que le code suivant ne sera pas exécuté après la redirection
} else {
    // Vérifier le rôle de l'utilisateur
    if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'admin2')) {
        header("Location: https://online-corps.com/admin-panel/");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Corps - Mon Espace</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="../cursor.css">
  <style>
	div .button-17 {
      margin-left: 10px;
    }
   
  </style>
</head>
<body>
  <a href="/" class="logo pointer" style="width: 50px;"><img src="/img/logo_transparent.png"></a>
  <nav class="navbar">
    <div class="nav-links">
      <ul>
        <h4 class="text-l">Online Corps - Mon Espace</h4>
          <a class="pointer" href="/">Accueil</a>
          <a class="pointer" href="https://online-corps.com/contact/">Contact</a>
          <a class="pointer" href="/connexion">Mon Espace</a>
          <a class="pointer" href="logout.php">Se déconnecter</a>
      </ul>
    </div>
    <img src="../img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
  </nav>
  
  <div class="welcome-message">
    <h1><?php echo htmlspecialchars($_SESSION['username']); ?>, Voici votre Espace.</h1>
    <hr>
    <h2>Gestion du Compte.</h2>
    <div>
      <button class="button-17 pointer" onclick="location.href='profile/index.php'">Mon Profil</button>
	</div>
  </div>

  <footer>
    <p>&copy; 2024 <a style="color: black;" class="pointer" href="/">online-corps.com</a>. Tous droits réservés.</p>
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