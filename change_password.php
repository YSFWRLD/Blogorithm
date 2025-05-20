<?php
// Start the session to access user information
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('includes/dbconnect.php');

// Initialize error and success messages
$error_message = '';
$success_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the current and new passwords
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $user_id = $_SESSION['user_id'];

    // Fetch the current password from the database
    $sql = "SELECT password FROM users WHERE id = '$user_id' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the old password matches the one in the database
        if (password_verify($old_password, $user['password'])) {
            // Check if the new password and confirm password match
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'";
                if ($conn->query($update_sql) === TRUE) {
                    $success_message = "Password updated successfully!";
                } else {
                    $error_message = "Error updating password.";
                }
            } else {
                $error_message = "New passwords do not match.";
            }
        } else {
            $error_message = "Incorrect old password.";
        }
    } else {
        $error_message = "User not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Blogorithm</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/change_password.css">
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>Change Password</h1>

        <!-- Display error or success messages -->
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <!-- Change Password Form -->
        <form action="change_password.php" method="POST">
            <label for="old_password">Old Password</label>
            <input type="password" id="old_password" name="old_password" required>

            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit" class="btn">Update Password</button>
        </form>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
