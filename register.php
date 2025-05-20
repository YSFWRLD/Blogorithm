<?php
// Start the session to access session variables
session_start();  // Add session_start() here

// Include database connection
include('includes/dbconnect.php');

// Initialize error message variable
$error_message = '';

// If form is submitted, process registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    // Check if passwords match
    if ($password != $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'user')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Blogorithm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script> <!-- Link to JavaScript file -->
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <div class="register-container">
            <h1>Sign Up</h1>

            <?php if (!empty($error_message)) { ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php } ?>

            <!-- Registration form -->
            <form action="register.php" method="POST" id="registrationForm">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="btn">Sign Up</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
