<?php
// Start the session to access user information
session_start();

// Include database connection
include('includes/dbconnect.php');

// Check if the post ID is passed in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post data from the database
    $sql_post = "SELECT * FROM posts WHERE id = $post_id";
    $result_post = $conn->query($sql_post);

    // If the post is found, display the post
    if ($result_post->num_rows > 0) {
        $post = $result_post->fetch_assoc();
    } else {
        // If the post doesn't exist, redirect to the homepage or a 404 page
        header('Location: index.php');
        exit();
    }
} else {
    // Redirect if no post ID is provided
    header('Location: index.php');
    exit();
}

// Fetch related posts (move this part above the connection close)
$category = $post['category'];
$sql_related = "SELECT * FROM posts WHERE category = '$category' AND id != $post_id LIMIT 3";
$result_related = $conn->query($sql_related);

// Close the database connection after all queries
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> - Blogorithm</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/post.css"> <!-- New CSS for the post page -->
</head>
<body>

    <?php include('includes/header.php'); ?>

    <main>
        <div class="post-container">
            <h1><?php echo $post['title']; ?></h1>
            <p class="post-meta">
                <strong>Author:</strong> <?php echo $post['author']; ?> | 
                <strong>Published on:</strong> <?php echo date("F j, Y", strtotime($post['created_at'])); ?>
            </p>
            
            <!-- Post content -->
            <div class="post-content">
                <p><?php echo nl2br($post['content']); ?></p>
            </div>

            <!-- Display the image (if available) -->
            <?php if (!empty($post['image_url'])) { 
                // Ensure the image_url does not have 'images/' already
                $image_url = $post['image_url'];
                if (strpos($image_url, 'images/') === false) {
                    $image_url = 'images/' . $image_url;  // Add 'images/' prefix if it's missing
                }
            ?>
                <div class="post-image">
                    <img src="<?php echo $image_url; ?>" alt="<?php echo $post['title']; ?>">
                </div>
            <?php } else { ?>
                <!-- Fallback image if no image is set -->
                <div class="post-image">
                    <img src="images/default.jpg" alt="default image">
                </div>
            <?php } ?>
            
            <!-- Related Posts Section -->
            <section class="related-posts">
                <h2>Related Posts</h2>
                <?php
                if ($result_related->num_rows > 0) {
                    while ($related_post = $result_related->fetch_assoc()) {
                        echo '<div class="related-post">';
                        echo '<a href="post.php?id=' . $related_post['id'] . '">' . $related_post['title'] . '</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No related posts available.</p>';
                }
                ?>
            </section>

        </div>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
