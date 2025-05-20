<?php
// Start session to manage user login state
session_start();

// Include database connection
include('includes/dbconnect.php');

// Initialize error message variable
$error_message = '';

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user data based on the username
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Successful login, store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // User role (admin or user)
            $_SESSION['registration_date'] = $user['registration_date']; // Store registration date

            // Redirect to the appropriate page based on the user's role
            if ($_SESSION['role'] == 'admin') {
                // Admin: Redirect to the admin dashboard
                header('Location: admin_dashboard.php');
            } else {
                // Normal user: Redirect to the home page (index)
                header('Location: index.php');
            }
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that username.";
    }
}

// Close database connection
$conn->close();
?>
