<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu 1 - Clic le plus rapide</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="game-container">
        <h1>Cliquez sur le bouton aussi vite que possible !</h1>
        <button id="start-button" onclick="startGame()">Commencer</button>
        <div id="game-area">
            <button id="target-button" onclick="clickTarget()"></button>
        </div>
        <div id="scoreboard">
            <p>Score: <span id="score">0</span></p>
            <p>Temps restant: <span id="time-left">30</span>s</p>
        </div>
        <div id="game-over" style="display: none;">
            <h2>Partie terminée !</h2>
            <p>Votre score est : <span id="final-score"></span></p>
            <button id="start-button" onclick="returnToMenu()">Retour au Menu</button>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
