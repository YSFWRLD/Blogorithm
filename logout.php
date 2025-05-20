<?php
// Start the session to manage user logout
session_start();

// Destroy the session to log the user out
session_unset();
session_destroy();

// Optionally, you can also set a logout message:
$_SESSION['logout_message'] = "You have successfully logged out.";

// Redirect to the homepage or login page after logout
header('Location: index.php'); // or header('Location: login.php');
exit();
?>
