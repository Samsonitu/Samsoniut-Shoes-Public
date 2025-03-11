function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const icon = passwordField.nextElementSibling.querySelector('i');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Real-time password validation
document.addEventListener('DOMContentLoaded', function() {
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const form = document.getElementById('changePasswordForm');
    
    // Update password requirements in real-time
    newPassword.addEventListener('input', function() {
        const value = newPassword.value;
        
        // Check length
        const lengthCheck = document.getElementById('length-check');
        if (value.length >= 8 && value.length <= 50) {
            lengthCheck.classList.add('text-success');
            lengthCheck.classList.remove('text-danger');
        } else {
            lengthCheck.classList.add('text-danger');
            lengthCheck.classList.remove('text-success');
        }
        
        // Check lowercase
        const lowercaseCheck = document.getElementById('lowercase-check');
        if (/[a-z]/.test(value)) {
            lowercaseCheck.classList.add('text-success');
            lowercaseCheck.classList.remove('text-danger');
        } else {
            lowercaseCheck.classList.add('text-danger');
            lowercaseCheck.classList.remove('text-success');
        }
        
        // Check uppercase
        const uppercaseCheck = document.getElementById('uppercase-check');
        if (/[A-Z]/.test(value)) {
            uppercaseCheck.classList.add('text-success');
            uppercaseCheck.classList.remove('text-danger');
        } else {
            uppercaseCheck.classList.add('text-danger');
            uppercaseCheck.classList.remove('text-success');
        }
        
        // Check number
        const numberCheck = document.getElementById('number-check');
        if (/\d/.test(value)) {
            numberCheck.classList.add('text-success');
            numberCheck.classList.remove('text-danger');
        } else {
            numberCheck.classList.add('text-danger');
            numberCheck.classList.remove('text-success');
        }
    });
    
    // Check if passwords match
    confirmPassword.addEventListener('input', function() {
        if (newPassword.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Mật khẩu không khớp');
        } else {
            confirmPassword.setCustomValidity('');
        }
    });
    
    // Form validation
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        // Additional check for password match
        if (newPassword.value !== confirmPassword.value) {
            event.preventDefault();
            confirmPassword.setCustomValidity('Mật khẩu không khớp');
        }
        
        form.classList.add('was-validated');
    });
});