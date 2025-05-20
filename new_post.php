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

// Get the logged-in user's name (from the session)
$username = $_SESSION['username'];  // Assuming the session has the username

// Initialize variables for form input
$title = $content = $category = $image_url = '';
$error_message = '';

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
        $image_url = 'images/' . $image_name;
        move_uploaded_file($image_tmp, $image_url);
    } else {
        $image_url = '';  // If no image is uploaded
    }

    // Insert the new post into the database
    $sql = "INSERT INTO posts (title, content, category, author, image_url) 
            VALUES ('$title', '$content', '$category', '$username', '$image_url')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to the dashboard or post page
        header('Location: admin_dashboard.php');
        exit();
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
    <title>Create New Post - Blogorithm</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/new_post.css">
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <h1>Create New Post</h1>

        <!-- Show error message if any -->
        <?php if (!empty($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>

        <!-- Post creation form -->
        <form action="new_post.php" method="POST" enctype="multipart/form-data">
            <label for="title">Post Title</label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>

            <label for="content">Post Content</label>
            <textarea id="content" name="content" rows="10" required><?php echo $content; ?></textarea>

            <label for="category">Category</label>
            <input type="text" id="category" name="category" value="<?php echo $category; ?>" required>

            <label for="image">Upload Image (Optional)</label>
            <input type="file" id="image" name="image">

            <!-- Hidden field to set the author automatically -->
            <input type="hidden" name="author" value="<?php echo $username; ?>">

            <button type="submit" class="btn">Create Post</button>
        </form>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
