function toggleMenu() {
    const menu = document.getElementById('uploadMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

// Optional: Close the dropdown if clicking outside of it
document.addEventListener('click', function(event) {
    const profile = document.querySelector('.profile');
    const menu = document.getElementById('uploadMenu');
    
    if (!profile.contains(event.target)) {
        menu.style.display = 'none';
    }
});

const overlay = document.getElementById('overlay');
const zoomedImage = document.getElementById('zoomedImage');
const audioPlayer = document.getElementById('audioPlayer');

function handleImageClick(image, audioSrc) {
    zoomedImage.src = image.src;
    overlay.classList.add('active');
    
    // Debugging
    console.log("Audio Source:", audioSrc);

    // Update the audio source and reload the audio element
    audioPlayer.src = audioSrc;
    audioPlayer.load();  // Reload the audio element to ensure it gets the new source
    audioPlayer.play();  // Play the audio
}

function closePopup() {
    overlay.classList.remove('active');
    audioPlayer.pause();
    audioPlayer.currentTime = 0; // Reset audio to the beginning
}

