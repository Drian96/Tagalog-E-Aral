// Select the first image and its corresponding audio
const image1 = document.getElementById('image1');
const audio1 = document.getElementById('audio1');

// Select the second image and its corresponding audio
const image2 = document.getElementById('image2');
const audio2 = document.getElementById('audio2');

// Overlay elements
const overlay = document.getElementById('overlay');
const zoomedImage = document.getElementById('zoomedImage');

// Function to handle the click event for any image
function handleImageClick(image, audio) {
    zoomedImage.src = image.src;
    overlay.classList.add('active');
    audio.play();
}

// Add event listeners to both images
image1.addEventListener('click', function() {
    handleImageClick(image1, audio1);
});

image2.addEventListener('click', function() {
    handleImageClick(image2, audio2);
});

// Function to close the popup and stop the audio
function closePopup() {
    overlay.classList.remove('active');
    audio1.pause();
    audio2.pause();
    audio1.currentTime = 0; // Reset audio1
    audio2.currentTime = 0; // Reset audio2
}
