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

// Charger les partenaires depuis le fichier partenaires.php
include 'partenaires.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Corps</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="/cursor.css">
  <style>
    /* Styles CSS existants */

    .partners {
      margin-top: 50px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .partners ul {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 0;
      list-style: none;
    }

    .partners li {
      width: 300px;
      background-color: #F2ADAD;
      margin: 20px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
    }

    .partners li:hover {
      transform: translateY(-10px);
    }

    .partners img {
      width: 51px;
      margin-bottom: 3px;
      margin-left: 7px;
      margin-top: 3px;
    }

    .partners h3 {
      font-size: 20px;
      margin-bottom: 5px;
    }

    .partners p {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .partners a {
      color: #fff;
      background-color: red;
      border: solid red 5px;
      border-radius: 10px;
    }

    .partners a:hover {
      color: gray;
      background-color: #ff5050;
      border-color: #ff5050;
    }
    
    .ttx {
      text-align: center;
      font-size: 7vh;
      margin-left: 5vh;
      color: white;
    }

    .im {
      border: solid #ff8181;
      margin-right: 230px;
      border-radius: 50px;
      margin-bottom: 10px;
    }
    
    @media screen and (max-with: 580px) {
        .partners img {
          margin-right: 5px;
        }
    }
    
    @media screen and (max-width: 950px) {
        .partners li {
          width: 100%;
          margin-left: 5vh;
          margin-right: 5vh;
        }

        .ttx {
        margin-left: 0vh;
		}
      	.partners im {
          width: 50px;
          margin-right: 5px;
    }
  </style>
</head>
<body>
  <a href="#" class="logo" style="width: 50px;"><img src="/img/logo_transparent.png"></a>
  <nav class="navbar">
    <div class="nav-links">
      <ul>
        <a class="text-l">Online Corps</a>
        <li><a class="pointer" href="/">Accueil</a></li>
        <li><a class="pointer" href="https://online-corps.com/contact/">Contact</a></li>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
          <li><a class="pointer" href="../mon_panel/index.php">Mon Espace</a></li>
          <li><a class="pointer" href="../mon-panel/logout.php">Se déconnecter</a></li>
        <?php else: ?>
          <li><a class="pointer" href="../connexion/index.php">Se connecter</a></li>
          <li><a class="pointer" href="../inscription/index.php">S'inscrire</a></li>
        <?php endif; ?>
      </ul>
    </div>
    <img src="../img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
  </nav>

  <header>
    <div>
      <br>
    </div>
  </header>

  <!-- Affichage de la liste des partenaires -->
  <h2 class="ttx">Nos partenaires</h2>
  <div class="partners">
    <ul>
      <?php foreach ($partners as $partner): ?>
        <li>
          <div class="im">
            <img src="<?= $partner['logo'] ?>" alt="Logo de <?= $partner['company_name'] ?>">
          </div>
          <p><strong><?= $partner['company_name'] ?></strong></p>
          <p><strong>Directeur:</strong> <?= $partner['director_name'] ?></p>
          <?php if (!empty($partner['address'])): ?>
            <p><strong>Adresse:</strong> <?= $partner['address'] ?></p>
          <?php endif; ?>
          <?php if (!empty($partner['website'])): ?>
            <p><a class="pointer" href="<?= $partner['website'] ?>">Voir site</a></p>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  
  <footer>
    <p>&copy; 2024 <a class="pointer" style="color: black;" class="pointer" href="http://online-corps.com">online-corps.com</a>. Tous droits réservés.</p>
  </footer>

  <!-- Bouton "Faire une demande" -->
  <a href="/partenariat/demande-partenaire" class="button-request">Faire une demande !</a>
  
  <script>
    const menuHamburger = document.querySelector(".menu-hamburger");
    const navLinks = document.querySelector(".nav-links");

    menuHamburger.addEventListener('click', () => {
      navLinks.classList.toggle('mobile-menu');
    });
  </script>
</body>
</html>
