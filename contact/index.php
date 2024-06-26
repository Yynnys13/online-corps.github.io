<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
  	<link rel="icon" href="/img/logo_transparent_flavion.png">
    <link rel="stylesheet" href="../cursor.css">
    <style>
        body {
            font-family: Arial, sans-serif;
          	background-image: url(../img/landscape.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
    		margin-top: 20vh;
		}
      
        a {
          font-size: 13px;
      	}
      
      	.ads {
          background-color: #ff9292c9;
          margin-left: 300px;
          margin-right: 300px;
          border-top: solid #ff929200 1px;
          border-bottom: solid #ff929200 10px;
          border-radius: 15px;
        }
      
        h2 {
			text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        button, .link-button {
            padding: 10px 20px;
            margin-bottom: 10px;
            background-color: #FF3F3F;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
        }
        button:hover, .link-button:hover {
            background-color: #c00;;
        }
        @media screen and (max-width: 695px) {
          .ads {
              background-color: #ffd5c4;
              margin-left: 50px;
              margin-right: 50px;
              border-top: solid #ffd5c4 1px;
              border-bottom: solid #ffd5c4 10px;
              border-radius: 15px;
          }
        }
    </style>
</head>
<body>
	<div class="ads">
        <h2>Quel service <br>désirez-vous utiliser ?</h2>
        <form method="post">
            <input type="hidden" name="to" value="contact@online-corps.com">
            <button class="pointer" type="submit" name="subject" value="Service Client">Service Client</button>
            <button class="pointer" type="submit" name="subject" value="Support technique">Support technique</button>
            <a href="../partenariat/demande-partenaire" class="link-button pointer">Demande de partenariat</a>
            <button class="pointer" type="submit" name="subject" value="Problème">Problème</button>
            <a href="https://online-corps.com/contact/admin/" class="link-button pointer">Admin</a>
            <button class="pointer" type="submit" name="subject" value="Autre">Autre</button>
        </form>
    </div>

    <?php
    if(isset($_POST['subject'])) {
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $body = '';
        $headers = 'From: votre_adresse_email@example.com';

        $mailto = 'mailto:' . $to . '?subject=' . $subject . '&body=' . $body;

        echo '<script>window.location.href = "'.$mailto.'";</script>';
    }
    ?>
</body>
</html>
