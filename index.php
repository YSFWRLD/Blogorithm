<?php
// Start the session to access user information
session_start();  // Add session_start() here

// Include database connection
include('includes/dbconnect.php');

// Fetch posts (or any page content)
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogorithm - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Include the header -->
    <?php include('includes/header.php'); ?>

    <main>
        <div class="welcome">
            <h1>Welcome to Blogorithm</h1>
            <p>Your go-to platform for tech and algorithms-inspired blogs!</p>
        </div>

        <!-- Display blog posts -->
        <section id="blog-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    
                    // Check if image_url exists before displaying
                    if (!empty($row['image_url'])) {
                        // If the image_url already contains the 'images/' directory, avoid adding it again
                        $image_path = 'images/' . ltrim($row['image_url'], 'images/');  // Remove 'images/' if it's already there

                        // Debugging: Output the image path
                        echo '<img src="' . $image_path . '" alt="' . htmlspecialchars($row['title']) . '">';
                    } else {
                        echo '<img src="images/default.jpg" alt="default image">';  // Fallback image if no image is set
                    }
            
                    echo '<div class="card-content">';
                    echo '<span class="category">' . $row['category'] . '</span>';
                    echo '<h2><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';
                    echo '<p>Posted on ' . date("F j, Y", strtotime($row['created_at'])) . '</p>';
                    echo '<p>' . substr($row['content'], 0, 100) . '...</p>';
                    echo '<a href="post.php?id=' . $row['id'] . '" class="btn">Read More</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No posts available.</p>';
            }

            $conn->close();
            ?>
        </section>
    </main>

    <!-- Include the footer -->
    <?php include('includes/footer.php'); ?>

</body>
</html>
