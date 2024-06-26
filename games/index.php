<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection de Jeux Intrigante</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Découvrez et Choisissez votre Jeu</h1>
        <div class="game-list">
            <div class="game" onclick="selectGame('speed-click', 'jeu1.jpg', 'Speed Click')" onmouseover="showDescription('description1')" onmouseout="hideDescription('description1')">
                <img src="jeu1.jpg" alt="Speed Click">
                <p>Jeu 1</p>
                <div class="description" id="description1">Une aventure épique vous attend dans le monde de Jeu 1.</div>
            </div>
            <div class="game" onclick="selectGame('jeu2', 'jeu2.jpg', 'Jeu 2')" onmouseover="showDescription('description2')" onmouseout="hideDescription('description2')">
                <img src="jeu2.jpg" alt="Jeu 2">
                <p>Jeu 2</p>
                <div class="description" id="description2">Plongez dans les mystères de Jeu 2 et découvrez ses secrets.</div>
            </div>
            <div class="game" onclick="selectGame('jeu3', 'jeu3.jpg', 'Jeu 3')" onmouseover="showDescription('description3')" onmouseout="hideDescription('description3')">
                <img src="jeu3.jpg" alt="Jeu 3">
                <p>Jeu 3</p>
                <div class="description" id="description3">Affrontez des défis palpitants dans l'univers de Jeu 3.</div>
            </div>
        </div>
        <div id="selected-game" class="selected-game">
            <h2>Vous avez choisi : <span id="game-name"></span></h2>
            <div id="game-frame" class="game-frame">
                <img id="game-image" src="" alt="Game Image">
                <button id="play-button">Jouer</button>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="game-modal" class="game-modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <div id="game-container"></div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
