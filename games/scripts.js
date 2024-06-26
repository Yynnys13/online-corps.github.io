function selectGame(gameId, imageUrl, gameName) {
    document.getElementById('game-name').textContent = gameName;
    document.getElementById('game-image').src = imageUrl;
    document.getElementById('play-button').onclick = function() {
        window.location.href = gameId + '';
    };
    document.getElementById('selected-game').style.display = 'block';
}

function showDescription(descriptionId) {
    document.getElementById(descriptionId).style.display = 'block';
}

function hideDescription(descriptionId) {
    document.getElementById(descriptionId).style.display = 'none';
}
