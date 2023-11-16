// sound.js

const audioContext = new (window.AudioContext || window.webkitAudioContext)();
let backgroundMusicSource;

function playBackgroundMusic() {
  fetch('sound/sound.mp3')
    .then(response => response.arrayBuffer())
    .then(buffer => audioContext.decodeAudioData(buffer))
    .then(audioBuffer => {
      backgroundMusicSource = audioContext.createBufferSource();
      backgroundMusicSource.buffer = audioBuffer;
      backgroundMusicSource.loop = true;
      backgroundMusicSource.connect(audioContext.destination);
      backgroundMusicSource.start();
    })
    .catch(error => console.error('Error loading or playing music:', error));
}

function stopBackgroundMusic() {
  if (backgroundMusicSource) {
    backgroundMusicSource.stop();
  }
}

document.addEventListener('DOMContentLoaded', playBackgroundMusic);

// Play/pause button
const playPauseButton = document.createElement('button');
playPauseButton.innerText = 'Pause';
playPauseButton.style.position = 'fixed';
playPauseButton.style.top = '10px';
playPauseButton.style.right = '10px';
document.body.appendChild(playPauseButton);

playPauseButton.addEventListener('click', () => {
  if (audioContext.state === 'suspended') {
    audioContext.resume();
  }

  if (audioContext.state === 'running') {
    stopBackgroundMusic();
    playPauseButton.innerText = 'Play';
  } else {
    playBackgroundMusic();
    playPauseButton.innerText = 'Pause';
  }
});
