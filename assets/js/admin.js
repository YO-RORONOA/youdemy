document.getElementById('adminLoginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Reset error states
    this.classList.remove('was-validated');
    document.getElementById('errorMessage').style.display = 'none';
    
    // Validate email
    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        showError('Please enter a valid email address');
        email.focus();
        return;
    }

    // Validate password
    const password = document.getElementById('password');
    if (password.value.length < 1) {
        showError('Password is required');
        password.focus();
        return;
    }
    console.log({ email: email.value, password: password.value });


    // If validation passes, submit the form
    this.submit();
});

function showError(message) {
    const errorDiv = document.getElementById('errorMessage');
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
}