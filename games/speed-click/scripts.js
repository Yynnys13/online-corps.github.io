let score = 0;
let timeLeft = 30;
let gameInterval;
let targetDisplayTime = 1000; // Initial target display time in milliseconds
let moveInterval;
const MOVE_INTERVAL = 2000; // Time in milliseconds to move the target every 2 seconds

function startGame() {
    score = 0;
    timeLeft = 30;
    targetDisplayTime = 1000;
    document.getElementById('score').textContent = score;
    document.getElementById('time-left').textContent = timeLeft;
    document.getElementById('start-button').style.display = 'none';
    document.getElementById('game-area').style.display = 'block';
    document.getElementById('game-over').style.display = 'none';
    gameInterval = setInterval(updateTime, 1000);
    moveInterval = setInterval(moveTarget, MOVE_INTERVAL);
    showTarget();
}

function updateTime() {
    if (timeLeft > 0) {
        timeLeft--;
        document.getElementById('time-left').textContent = timeLeft;
    } else {
        endGame();
    }
}

function endGame() {
    clearInterval(gameInterval);
    clearInterval(moveInterval);
    document.getElementById('target-button').style.display = 'none';
    const redTargets = document.getElementsByClassName('red-target');
    while (redTargets.length > 0) {
        redTargets[0].parentNode.removeChild(redTargets[0]);
    }
    document.getElementById('game-over').style.display = 'block';
    document.getElementById('final-score').textContent = score;
    document.getElementById('start-button').style.display = 'block';
    document.getElementById('game-area').style.display = 'none';
}

function showTarget() {
    const gameArea = document.getElementById('game-area');
    const target = document.getElementById('target-button');
    const gameAreaRect = gameArea.getBoundingClientRect();
    const maxX = gameAreaRect.width - target.offsetWidth;
    const maxY = gameAreaRect.height - target.offsetHeight;

    const randomX = Math.max(0, Math.floor(Math.random() * maxX));
    const randomY = Math.max(0, Math.floor(Math.random() * maxY));

    target.style.left = `${randomX}px`;
    target.style.top = `${randomY}px`;
    target.style.display = 'block';

    if (score % 10 === 0 && score > 0) {
        const redTarget = document.createElement('div');
        redTarget.classList.add('red-target');
        redTarget.onclick = function() {
            endGame();
        };
        redTarget.style.position = 'absolute';
        redTarget.style.width = '50px';
        redTarget.style.height = '50px';
        redTarget.style.backgroundColor = 'red';
        const redRandomX = Math.max(0, Math.floor(Math.random() * maxX));
        const redRandomY = Math.max(0, Math.floor(Math.random() * maxY));
        redTarget.style.left = `${redRandomX}px`;
        redTarget.style.top = `${redRandomY}px`;
        gameArea.appendChild(redTarget);
    }
}

// Fonction pour déplacer la cible
function moveTarget() {
    showTarget();
}

function clickTarget() {
    score++;
    document.getElementById('score').textContent = score;
    document.getElementById('target-button').style.display = 'none';

    // Increase speed every 10 points
    if (score % 10 === 0) {
        targetDisplayTime = Math.max(300, targetDisplayTime - 200); // Reduce the display time by 200ms, but not below 300ms
    }

    showTarget();
}

// Fonction pour redémarrer le jeu
function restartGame() {
    document.getElementById('game-over').style.display = 'none';
    startGame();
}

// Fonction pour rediriger vers /games/
function returnToMenu() {
    window.location.href = '/';
}
