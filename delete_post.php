<?php
// Start the session
session_start();

// Include database connection
include('includes/dbconnect.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the logged-in user's username (from the session)
$username = $_SESSION['username'];
$role = $_SESSION['role']; // Get the user's role (admin or user)

// Get the post ID from the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch post data from the database
    $sql = "SELECT * FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();

    // Check if the logged-in user is the author or if the user is an admin
    if ($post['author'] != $username && $role != 'admin') {
        // If the logged-in user is not the author and not an admin, redirect to dashboard
        header('Location: dashboard.php');
        exit();
    }

    // Delete the post from the database
    $sql_delete = "DELETE FROM posts WHERE id = $post_id";
    if ($conn->query($sql_delete) === TRUE) {
        // If the user is an admin, redirect to admin_dashboard.php, else to the user dashboard
        if ($role == 'admin') {
            header('Location: admin_dashboard.php');  // Admin redirects to admin dashboard
        } else {
            header('Location: dashboard.php');  // Regular user redirects to their dashboard
        }
        exit();
    } else {
        // Handle delete error
        echo "Error: " . $conn->error;
    }
} else {
    // Redirect if no post ID is provided
    header('Location: dashboard.php');
    exit();
}

// Close the database connection
$conn->close();
?>
