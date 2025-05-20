<?php
// Start the session to access user information
//session_start();  // Add session_start() here

// Include database connection
include('includes/dbconnect.php');

// Fetch posts (or any page content)
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if the user is already logged in, redirect to homepage if true
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Initialize error message variable
$error_message = '';

// If the form is submitted, check for login errors
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include process_login.php for processing the login logic
    include('process_login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blogorithm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script> <!-- Link to the JavaScript file -->
</head>
<body class="login-page">
    <?php include('includes/header.php'); ?>

    <main>
        <div class="login-container">
            <h1>Login</h1>

            <!-- Show error message if login fails -->
            <?php if (isset($error_message) && $error_message != '') { ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php } ?>

            <!-- Login form -->
            <form action="login.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn">Login</button>
            </form>

            <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
