<?php
session_start();

// Vérifier le rôle de l'utilisateur
if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
  
  if ($role === 'user') {
    header("Location: https://online-corps.com/mon-panel/");
    exit;
  } elseif ($role === 'admin2') {
    // Vérifier le temps écoulé depuis le dernier rafraîchissement
    $last_refresh = isset($_SESSION['last_refresh']) ? $_SESSION['last_refresh'] : 0;
    $current_time = time();
    $elapsed_time = $current_time - $last_refresh;

    if ($elapsed_time > 5) { // Si plus de 20 secondes se sont écoulées
      echo '<script>';
      echo 'if(confirm("Nous remarquons que vous êtes Admin, voulez-vous aller dans votre espace !!")) {';
      echo 'window.location.replace("https://online-corps.com/admin2-panel/");';
      echo '}';
      echo '</script>';
    }
  }
}

// Mettre à jour le temps de dernier rafraîchissement
$_SESSION['last_refresh'] = time();

// Inclure le fichier partenaires.php
include '../partenariat/partenaires.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Corps - Espace Admin</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../cursor.css">
  <style>
    .partnership-popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border: 2px solid #ccc;
      border-radius: 25px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 80%;
      max-height: 80%;
      overflow: auto;
      display: none;
    }

    .partner img {
      max-width: 15%;
      height: auto;
      border: 1px solid #ccc;
      background-color: #afafaf;
      border-radius: 20px;
      margin: 7px;
      margin-bottom: 65px;
    }
    
    .partner {
      border: 5px solid #ccc;
      border-radius: 15px;
      background-color: #e5e5e5;
      display: flex;
      margin-bottom: 10px;
    }
    
    .partner h3 {
      margin: 5px;
      margin-left: 10px;
	}
    
    .partner p {
      margin: 5px;
      margin-left: 10px;
      flex: 1;
  	}

    .close-btn {
      color: #353535;
      position: absolute;
      top: 8px;
      right: 10px;
      cursor: pointer;
      font-size: 29px;
      background-color: #ff1212;
      border-left: solid #ff1212 10px;
      border-right: solid #ff1212 10px;
      align-content: center;
      font-family: fantasy;
      border-radius: 10px;
    }
    
    .close-btn:hover {
      color: #fff;
      background-color: #8b0000;
      border-left: solid #8b0000 10px;
      border-right: solid #8b0000 10px;
    }
    
    div .button-17 {
      margin-left: 10px;
    }
    
  </style>
</head>

    <a href="/" class="logo pointer" style="width: 50px;"><img src="/img/logo_transparent.png"></a>
  <nav class="navbar">
    <div class="nav-links ">
      <ul>
        <h4 class="text-l">Online Corps - Espace Admin</h4>
        <a class="pointer" href="/" href="/">Accueil</a>
        <a class="pointer" href="https://online-corps.com/contact/">Contact</a>
        <a class="pointer" href="/connexion" href="/connexion">Mon Espace</a>
        <a class="pointer" href="logout.php" href="logout.php">Se déconnecter</a>
      </ul>
    </div>
    <img src="../img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
  </nav>
  
<div class="welcome-message">
    <h1><?php echo htmlspecialchars($_SESSION['username']); ?>, Voici votre Espace.</h1>
    <hr>
    <h2>Gestion du Compte.</h2>
    	<button class="button-17 pointer" onclick="location.href='/mon-panel/profile/index.php'">Mon Profile</button>
    <h2>Gestion d'Admin.</h2>
    	<button class="button-17 pointer" onclick="location.href='/admin/user/index.php'">Gérers les Comptes</button>
    	<button class="button-17 pointer" id="partnership-btn">Partenariat</button>
</div>
<body>

  <div id="partnership-block" class="partnership-popup">
    <span class="close-btn" id="close-btn">&times;</span>
    <h2>Partenariats</h2>
    <?php foreach ($partners as $partner): ?>
      <div class="partner">
        <img src="<?php echo $partner['logo']; ?>" alt="<?php echo $partner['company_name']; ?>">
        <div class="partner-info">
          <h3><?php echo $partner['company_name']; ?></h3>
          <p>Directeur/rice: <?php echo $partner['director_name']; ?></p>
          <p>Adresse: <?php echo $partner['address'] ? $partner['address'] : 'Non Précisé'; ?></p>
          <p>Site: <a href="<?php echo $partner['website'] ? $partner['website'] : '#'; ?>"><?php echo $partner['website'] ? $partner['website'] : 'Non Précisé'; ?></a></p>
          <p>Description: <?php echo $partner['description'] ? $partner['description'] : 'Non Précisé'; ?></p>
        </div>
      </div>
    <?php endforeach; ?>
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

  const partnershipBtn = document.getElementById('partnership-btn');
  const partnershipBlock = document.getElementById('partnership-block');
  const closeBtn = document.getElementById('close-btn');

  partnershipBtn.addEventListener('click', () => {
    partnershipBlock.style.display = partnershipBlock.style.display === "none" || partnershipBlock.style.display === "" ? "block" : "none";
  });

  closeBtn.addEventListener('click', () => {
    partnershipBlock.style.display = "none";
  });
  </script>
</body>
</html>