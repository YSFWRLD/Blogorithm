<?php
// Start the session to access user information
session_start();  // Session start to access the user role or session data

// Include database connection
include('includes/dbconnect.php');

// Ensure the user is logged in as an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');  // Redirect to login if not an admin
    exit();
}

// Fetch total posts count
$sql_posts = "SELECT COUNT(*) AS total_posts FROM posts";
$result_posts = $conn->query($sql_posts);
$total_posts = $result_posts->fetch_assoc()['total_posts'];

// Fetch total users count
$sql_users = "SELECT COUNT(*) AS total_users FROM users";
$result_users = $conn->query($sql_users);
$total_users = $result_users->fetch_assoc()['total_users'];

// Fetch the total distinct categories count from posts table
$sql_categories = "SELECT COUNT(DISTINCT category) AS total_categories FROM posts";
$result_categories = $conn->query($sql_categories);
$total_categories = $result_categories->fetch_assoc()['total_categories'];

// Fetch the total admin users count
$sql_admin_users = "SELECT COUNT(*) AS total_admins FROM users WHERE role = 'admin'";
$result_admin_users = $conn->query($sql_admin_users);
$total_admins = $result_admin_users->fetch_assoc()['total_admins'];

// Fetch the most recent posts
$sql_recent_posts = "SELECT id, title, created_at FROM posts ORDER BY created_at DESC LIMIT 5";
$result_recent_posts = $conn->query($sql_recent_posts);

// Fetch all users
$sql_all_users = "SELECT id, username, role, created_at FROM users ORDER BY created_at DESC";
$result_users_list = $conn->query($sql_all_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Blogorithm</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_dashboard.css"> <!-- New CSS file -->
</head>

<body>

    <!-- Include the header -->
    <?php include('includes/header.php'); ?>

    <main>
        <!-- Admin Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Posts</h3>
                <p><?php echo $total_posts; ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <!-- New Stats -->
            <div class="stat-card">
                <h3>Total Categories</h3>
                <p><?php echo $total_categories; ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Admin Users</h3>
                <p><?php echo $total_admins; ?></p>
            </div>
        </div>

        <!-- Display the recent posts -->
<section class="recent-posts">
    <h2>Recent Posts</h2>
    <?php
    if ($result_recent_posts->num_rows > 0) {
        while ($row = $result_recent_posts->fetch_assoc()) {
            echo '<div class="post">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p>Posted on: ' . date("F j, Y", strtotime($row['created_at'])) . '</p>';
            echo '<div class="post-actions">';
            echo '<button class="edit-button"><a href="edit_post.php?id=' . $row['id'] . '" style="color: white; text-decoration: none;">Edit</a></button>';
            echo '<button class="delete-button" onclick="return confirm(\'Are you sure you want to delete this post?\')"><a href="delete_post.php?id=' . $row['id'] . '" style="color: white; text-decoration: none;">Delete</a></button>';
            echo '</div>'; // end post-actions
            echo '</div>'; // end post
        }
    } else {
        echo '<p>No posts available.</p>';
    }
    ?>
</section>


        <!-- User Management Section -->
        <section class="user-management">
    <h2>User Management</h2>
    <?php
    if ($result_users_list->num_rows > 0) {
        while ($row = $result_users_list->fetch_assoc()) {
            echo '<div class="user-card">';
            echo '<h3>' . $row['username'] . '</h3>';
            echo '<p>Role: ' . ucfirst($row['role']) . '</p>';
            echo '<p>Created on: ' . date("F j, Y", strtotime($row['created_at'])) . '</p>';
            echo '<div class="user-actions">';
            echo '<button class="edit-button"><a href="edit_user.php?id=' . $row['id'] . '" style="color: white;">Edit</a></button>';
            echo '<button class="delete-button" onclick="return confirm(\'Are you sure you want to delete this user?\')"><a href="delete_user.php?id=' . $row['id'] . '" style="color: white;">Delete</a></button>';
            echo '</div>'; // end user-actions
            echo '</div>'; // end user-card
        }
    } else {
        echo '<p>No users found.</p>';
    }
    ?>
</section>


    </main>

    <!-- Close the database connection at the end -->
    <?php
    $conn->close();
    ?>

</body>
</html>
