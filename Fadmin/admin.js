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