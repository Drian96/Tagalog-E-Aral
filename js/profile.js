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
    if (isUnlocked) {
        alert("This badge is already unlocked!");
        return;
    }

    const badgeName = badgeElement.getAttribute("data-badge-name");
    const requiredStars = badgeElement.getAttribute("data-required-stars");
    const badgeId = badgeElement.getAttribute("data-badge-id");

    const modal = document.getElementById("badgeModal");
    document.getElementById("modalBadgeName").textContent = badgeName;
    document.getElementById("modalBadgeStars").textContent = `Required Stars: ${requiredStars}`;
    const unlockButton = document.getElementById("unlockButton");
    unlockButton.setAttribute("data-badge-id", badgeId);
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

    // Send AJAX request to unlock badge
    fetch("../../user/easy/unlockBadge.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ badgeId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const badgeContainer = document.querySelector(`.container[data-badge-id="${badgeId}"]`);
                const badgeImage = badgeContainer.querySelector(".container-image");
                badgeImage.src = data.newImagePath;

                badgeContainer.setAttribute("data-unlocked", "true");
                alert("Badge unlocked successfully!");
            } else {
                alert(data.message);
            }
            closeBadgeModal();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Failed to unlock badge.");
        });
}

