<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demande de Partenariat</title>
  <link rel="icon" href="/img/logo_transparent_flavion.png">
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="/cursor.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      position: relative;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="url"],
    .form-container textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .form-container button {
      width: 100%;
      padding: 10px;
      background-color: #FF3434;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .form-container button:hover {
      background-color: #FFB4B4;
    }

    .form-container .note {
      text-align: center;
      font-size: 14px;
      margin-top: 10px;
    }

    .form-container .required {
      color: red;
    }

    .back-button {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: #ccc;
      color: #000;
      border: none;
      border-radius: 5px;
      padding: 10px;
      cursor: pointer;
    }
    
  </style>
</head>
<body>
  <button class="back-button" onclick="window.history.back()">Retour</button>
  <div class="form-container">
    <h2>Demande de Partenariat</h2>
    <form id="partnershipForm">
      <label for="logoUrl">Lien du logo <span class="required">*</span><a style="color:#ae0000; margin-left:10px; font-size:10px;">Image recommandée 500x500 <span class="required">**</span></a></label>
      <input class="text" type="url" id="logoUrl" name="logoUrl" required placeholder="Exemple: https://exemple.com/logo.png">

      <label for="companyName">Nom de la compagnie <span class="required">*</span></label>
      <input class="text" type="text" id="companyName" name="companyName" required placeholder="Exemple: Mon Entreprise">

      <label for="directorName">Nom du Directeur/rice <span class="required">*</span></label>
      <input class="text" type="text" id="directorName" name="directorName" required placeholder="Exemple: Jean Dupont">

      <label for="address">Adresse</label>
      <input class="text" type="text" id="address" name="address" placeholder="Exemple: 123 Rue Principale, Ville, Pays">

      <label for="website">Site Web</label>
      <input class="text" type="url" id="website" name="website" placeholder="Exemple: https://exemple.com">

      <button class="pointer" type="submit">Envoyer la demande</button>
      <div class="note">Les champs marqués de deux <span class="required">*</span> sont des recommandations.</div>
      <div class="note">Les champs marqués d'un <span class="required">*</span> sont obligatoires.</div>
    </form>
  </div>

  <script>
    document.getElementById('partnershipForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const logoUrl = document.getElementById('logoUrl').value;
      const companyName = document.getElementById('companyName').value;
      const directorName = document.getElementById('directorName').value;
      const address = document.getElementById('address').value || 'Non Précisé';
      const website = document.getElementById('website').value || 'Non Précisé';

      const img = new Image();
      img.onload = function() {
        if (this.width !== this.height) {
          alert("L'image ne fait pas du 500x500 environ.");
        } else {
          const subject = 'Demande de partenariat';
          const body = `Lien du logo: ${logoUrl}\nNom de la compagnie: ${companyName}\nNom du Directeur/rice: ${directorName}\nAdresse: ${address}\nSite Web: ${website}`;
          window.location.href = `mailto:contact@online-corps.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        }
      };
      img.onerror = function() {
        alert("L'image n'a pas pu être chargée. Veuillez vérifier l'URL.");
      };
      img.src = logoUrl;
    });
  </script>
</body>
</html>
