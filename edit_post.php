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

// Get the post ID from the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch post data from the database
    $sql = "SELECT * FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();

    // Check if the logged-in user is the author of the post or an admin
    if ($post['author'] != $_SESSION['username'] && $_SESSION['role'] != 'admin') {
        // Redirect to the dashboard if the user is not the author and not an admin
        header('Location: dashboard.php');
        exit();
    }
} else {
    // Redirect if no post ID is provided
    header('Location: dashboard.php');
    exit();
}

// Initialize variables for form input
$title = $content = $category = $image = $error_message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    
    // Handle image upload (optional)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = 'images/' . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // Use the existing image if no new image is uploaded
        $image_path = $post['image_url']; 
    }

    // Update the post in the database
    $sql_update = "UPDATE posts SET 
                    title = '$title', 
                    content = '$content', 
                    category = '$category', 
                    image_url = '$image_path' 
                    WHERE id = $post_id";
    
    if ($conn->query($sql_update) === TRUE) {
        // Redirect based on user role
        if ($_SESSION['role'] == 'admin') {
            header('Location: admin_dashboard.php');
            exit();
        } else {
            header('Location: dashboard.php');
            exit();
        }
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Blogorithm</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/edit_post.css"> <!-- New CSS file -->
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>Edit Post</h1>

        <!-- Show error message if any -->
        <?php if (!empty($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>

        <!-- Edit post form -->
        <form action="edit_post.php?id=<?php echo $post['id']; ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Post Title</label>
            <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" required>

            <label for="content">Post Content</label>
            <textarea id="content" name="content" rows="10" required><?php echo $post['content']; ?></textarea>

            <label for="category">Category</label>
            <input type="text" id="category" name="category" value="<?php echo $post['category']; ?>" required>

            <label for="image">Upload Image (Optional)</label>
            <input type="file" id="image" name="image">

            <button type="submit" class="btn">Update Post</button>
        </form>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
