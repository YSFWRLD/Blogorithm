<?php
// Start the session to access user information
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

// Fetch posts created by the user (using the username to link posts)
$sql_posts = "SELECT id, title, created_at FROM posts WHERE author = '$username'";
$result_posts = $conn->query($sql_posts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Blogorithm</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>User Dashboard</h1>

        <!-- Profile Overview -->
        <section class="profile-overview">
            <h2>Profile Overview</h2>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Member Since:</strong> <?php echo $_SESSION['registration_date']; ?></p>
        </section>

        <!-- My Posts -->
        <section class="my-posts">
    <h2>
        My Posts
        <a href="new_post.php" class="create-post-icon"> + </a>
    </h2>
    <?php
    if ($result_posts->num_rows > 0) {
        while ($row = $result_posts->fetch_assoc()) {
            echo '<div class="post">';
            echo '<h3><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h3>';
            echo '<p>Posted on: ' . date("F j, Y", strtotime($row['created_at'])) . '</p>';
            echo '<a href="edit_post.php?id=' . $row['id'] . '" class="btn">Edit</a>';
            echo ' | ';
            echo '<a href="delete_post.php?id=' . $row['id'] . '" class="btn">Delete</a>';
            echo '</div>';
        }
    } else {
      echo '<p>No posts created yet.</p>';
            }
            ?>
        </section>

        <!-- Link to Change Password Page -->
        <section class="change-password-link">
            <a href="change_password.php" class="btn">Change Password</a>
        </section>

    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
