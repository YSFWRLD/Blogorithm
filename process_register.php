<?php
// Start session to manage registration state
session_start();

// Include database connection
include('includes/dbconnect.php');

// Initialize error message variable
$error_message = '';
$success_message = '';

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve form data and escape to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input fields
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Check if the username already exists
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Username or email already exists
            $error_message = "Username or email already taken!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            
            // Insert the new user into the database
            $insert_sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if ($conn->query($insert_sql) === TRUE) {
                // Registration successful, redirect to login page with success message
                $success_message = "Registration successful! Please login.";
                header('Location: login.php'); // Redirect to login page
                exit();
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }
    }
}

// Close database connection
$conn->close();
?>
