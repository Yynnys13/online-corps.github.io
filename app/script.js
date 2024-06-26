const downloadButton = document.getElementById('downloadButton');
const downloadFrame = document.getElementById('downloadFrame');
const thankYouDiv = document.querySelector('.thankYou');

downloadButton.addEventListener('click', () => {
  downloadFrame.src = "https://wira.adem.my.id/?source=youtube&title=WaKZHgX3XP&type=apk&download=aHR0cHM6Ly9kb3dubG9hZDk0NC5tZWRpYWZpcmUuY29tLzdvanNpN2xvM3U0Z1kwUjZ2RTBUcWVxT0E5UllyVFVhNWx5dTU5VW5zZDdvTV9oRmZGUzRBSjhtVGZJa1otYmkydFk5dWs5MXNadFBKUXNZRTVqWkFEWFBFRV9tUHp1WXd0cWN3NTJzaUp6TDhyOUc2dUVIVGdBWnFTRUhHMVhqeXRqY19oeWpzbnRVNFg5OFh6YW5pcV9uOFlEZWJTOVVuYUdnYi1zSGpQY0c1QS92cW5zenNsYzRvMG9xem0vT25saW5lK0NvcnBzLmFwaw%3D%3D";
  downloadFrame.style.display = "block";
  downloadButton.style.display = "none";
  thankYouDiv.style.display = "block";
});
