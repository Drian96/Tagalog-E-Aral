function toggleMenu() {
    const menu = document.getElementById('profileMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

//close the drop down if clicking outside
document.addEventListener('click', function(event) {
    const profile = document.querySelector('.profile');
    const menu = document.getElementById('profileMenu');
    
    if (!profile.contains(event.target)) {
        menu.style.display = 'none';
    }
});

//badges
// Toggle dropdown menu
function toggleMenu() {
    const menu = document.getElementById("profileMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// Open badge modal
function openBadgeModal(badgeElement) {
    const isUnlocked = badgeElement.getAttribute("data-unlocked") === "true";
    const badgeName = badgeElement.getAttribute("data-badge-name");
    const requiredStars = badgeElement.getAttribute("data-required-stars");
    const badgeId = badgeElement.getAttribute("data-badge-id");

    const modal = document.getElementById("badgeModal");
    const unlockButton = document.getElementById("unlockButton");

    document.getElementById("modalBadgeName").textContent = badgeName;
    document.getElementById("modalBadgeStars").textContent = `Required Stars: ${requiredStars}`;

    unlockButton.setAttribute("data-badge-id", badgeId);
    unlockButton.setAttribute("data-required-stars", requiredStars);

    if (isUnlocked) {
        showPopup("This badge is already unlocked!", "info");
        return;
    }

    modal.style.display = "block";
}

// Close badge modal
function closeBadgeModal() {
    const modal = document.getElementById("badgeModal");
    modal.style.display = "none";
}

// Unlock badge
function unlockBadge() {
    const badgeId = document.getElementById("unlockButton").getAttribute("data-badge-id");
    const requiredStars = document.getElementById("unlockButton").getAttribute("data-required-stars");

    // Prepare form data
    const formData = new FormData();
    formData.append("badgeId", badgeId);
    formData.append("requiredStars", requiredStars);

    fetch("unlockBadge.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            closeBadgeModal();
            showPopup(data.message, data.success ? "success" : "error");
            if (data.success) {
                // Update badge image and state
                const badgeContainer = document.querySelector(`.container[data-badge-id="${badgeId}"]`);
                const badgeImage = badgeContainer.querySelector(".container-image");
                badgeImage.src = data.newImagePath;

                badgeContainer.setAttribute("data-unlocked", "true");
                badgeContainer.classList.add("badge-unlocked");
                updateStarsDisplay();
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            showPopup("Failed to unlock badge.", "error");
        });
}

// Update the displayed stars count after unlocking a badge
function updateStarsDisplay() {
    const totalStarsElement = document.querySelector(".star-text");
    const newStars = parseInt(totalStarsElement.textContent, 10) - parseInt(document.getElementById("unlockButton").getAttribute("data-required-stars"), 10);
    totalStarsElement.textContent = newStars;
}

// Show a custom popup
function showPopup(message, type) {
    const popup = document.createElement("div");
    popup.className = `custom-popup ${type}`;
    popup.textContent = message;

    document.body.appendChild(popup);

    // Add fade-in animation
    setTimeout(() => popup.classList.add("visible"), 100);

    // Remove popup after 3 seconds
    setTimeout(() => {
        popup.classList.remove("visible");
        setTimeout(() => popup.remove(), 500);
    }, 3000);
}

// Add event listener to close modal when clicking outside it
window.addEventListener("click", function (event) {
    const modal = document.getElementById("badgeModal");
    if (event.target === modal) {
        closeBadgeModal();
    }
});


