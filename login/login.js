// Toggle password visibility
function togglePassword(fieldId) {
    var field = document.getElementById(fieldId);
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

// Real-time password validation
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm_password');
const passwordWarning = document.getElementById('password-warning');
const confirmPasswordWarning = document.getElementById('confirm-password-warning');

passwordInput.addEventListener('input', function() {
    const password = passwordInput.value;
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).+$/; // At least one uppercase and one number

    if (!passwordRegex.test(password)) {
        passwordWarning.textContent = 'Password must contain at least one uppercase letter and one number!';
    } else {
        passwordWarning.textContent = '';
    }

    // Check if passwords match during input
    if (confirmPasswordInput.value !== password) {
        confirmPasswordWarning.textContent = 'Passwords do not match!';
    } else {
        confirmPasswordWarning.textContent = '';
    }
});

confirmPasswordInput.addEventListener('input', function() {
    if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordWarning.textContent = 'Passwords do not match!';
    } else {
        confirmPasswordWarning.textContent = '';
    }
});