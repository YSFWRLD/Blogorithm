<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

include('includes/dbconnect.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Check if the user is an admin (cannot delete an admin)
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "User not found.";
        exit();
    }

    if ($user['role'] == 'admin') {
        echo "You cannot delete an admin user.";
        exit();
    }

    // Delete user
    $delete_query = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conn, $delete_query)) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "No user ID provided.";
    exit();
}
?>
