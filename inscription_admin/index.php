<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: /mon-panel/');
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Corps - Inscription</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="../cursor.css">
</head>
<body>
<a href="/" class="logo pointer" style="width: 50px;"><img src="/img/logo_transparent.png"></a>
<nav class="navbar">
    <div class="nav-links ">
      <ul>
        <a class="text-l">Online Corps - Inscription</a>
        <li><a class="pointer" href="/">Accueil</a></li>
        <li><a class="pointer" href="https://online-corps.com/contact/">Contact</a></li>
        <li><a class="pointer" href="/connexion">Se connecter</a></li>
        <li><a class="pointer" href="/inscription">S'inscrire</a></li>
      </ul>
    </div>
    <img src="../img/menu-btn.png" alt="menu hamburger" class="menu-hamburger">
</nav>
<div class="main-content">
  <h1 class="jomolhari-regular">Créer un compte</h1>
  <form id="registrationForm" method="post" action="inscription.php">
    <label for="firstName">Prénom</label><br>
    <input class="pointer" type="text" id="firstName" name="firstName" required><br><br>
    <label for="lastName">Nom</label><br>
    <input class="pointer" type="text" id="lastName" name="lastName" required><br><br>
    <label for="companyName">Nom de l'entreprise</label><br>
    <input class="pointer" type="text" id="companyName" name="companyName" required><br><br>
    <label for="username">Nom d'utilisateur</label><br>
    <input class="pointer" type="text" id="username" name="username" required><br><br>
    <label for="email">Adresse e-mail</label><br>
    <input class="pointer" type="email" id="email" name="email" required><br><br>
    <label for="password">Mot de passe</label><br>
    <input class="pointer" type="password" id="password" name="password" required><br><br>
    <label for="confirmPassword">Confirmer le mot de passe</label><br>
    <input class="pointer" type="password" id="confirmPassword" name="confirmPassword" required><br><br>
    <label for="adminCode">Code administrateur</label><br>
    <input class="pointer" type="text" id="adminCode" name="adminCode"><br><br>
    <div class="button-container">
      <button type="submit" class="button-inscription pointer">S'inscrire</button>
      <button type="button" class="button-17 pointer" onclick="location.href='/connexion/';">Se connecter</button>
    </div>
    <div id="message" class="message"><?php echo isset($_GET['error']) ? htmlspecialchars($_GET['error']) : ''; ?></div>
  </form>
</div>
</body>
<footer>
  <p>&copy; 2024 <a style="color: black;" class="pointer" href="/">online-corps.fr</a>. Tous droits réservés.</p>
</footer>
<script>
  const menuHamburger = document.querySelector(".menu-hamburger");
  const navLinks = document.querySelector(".nav-links");

  menuHamburger.addEventListener('click', () => {
    navLinks.classList.toggle('mobile-menu');
  });

  function validateForm() {
    var firstName = document.getElementById('firstName').value.trim();
    var lastName = document.getElementById('lastName').value.trim();
    var companyName = document.getElementById('companyName').value.trim();
    var username = document.getElementById('username').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var adminCode = document.getElementById('adminCode').value.trim();
    var message = document.getElementById('message');

    console.log(firstName, lastName, companyName, username, email, password, confirmPassword, adminCode);

    if (!firstName || !lastName || !companyName || !username || !email || !password || !confirmPassword) {
      message.textContent = 'Tous les champs doivent être remplis.';
      message.className = 'message error';
      return false;
    }

    if (password !== confirmPassword) {
      message.textContent = 'Les mots de passe ne correspondent pas.';
      message.className = 'message error';
      return false;
    }

    message.textContent = 'Validation réussie. Traitement en cours...';
    message.className = 'message success';

    return true;
  }
</script>
</html>

