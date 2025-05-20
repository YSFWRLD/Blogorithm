// script.js

// Function to validate the login form
function validateLoginForm(event) {
    // Prevent form submission if validation fails
    event.preventDefault();

    // Get form input values
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    // Validate the fields
    if (username === '') {
        alert('Username is required!');
        return false; // Stop form submission
    }

    if (password === '') {
        alert('Password is required!');
        return false; // Stop form submission
    }

    // If all fields are valid, submit the form
    document.querySelector('form').submit();
}

// Add event listener to the form submit button
document.querySelector('form').addEventListener('submit', validateLoginForm);


// script.js

// Function to validate the registration form
function validateRegistrationForm(event) {
    // Prevent form submission if validation fails
    event.preventDefault();

    // Get form input values
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();

    // Validate the fields
    if (username === '') {
        alert('Username is required!');
        return false; // Stop form submission
    }

    if (password === '') {
        alert('Password is required!');
        return false; // Stop form submission
    }

    if (confirmPassword === '') {
        alert('Please confirm your password!');
        return false; // Stop form submission
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return false; // Stop form submission
    }

    // If all fields are valid, submit the form
    document.querySelector('form').submit();
}

// Add event listener to the form submit button
document.querySelector('form').addEventListener('submit', validateRegistrationForm);
