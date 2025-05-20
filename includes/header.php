<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- includes/header.php -->
<header>
    <div class="container">
        <a href="index.php" class="logo">Blogorithm</a>
        <nav>
            <ul>
                <!-- Check if the current page is post.php -->
                <?php if (basename($_SERVER['PHP_SELF']) == 'post.php'): ?>
                    <!-- Add Home link for post.php -->
                    <li><a href="index.php">Home</a></li>
                <?php endif; ?>

                <!-- <?php if (isset($_SESSION['user_id'])): ?> -->
                    <!-- If user is logged in -->
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <!-- Admin: Show Home and Logout on admin_dashboard.php -->
                        <?php if (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php'): ?>
                            <li><a href="index.php">Home</a></li> <!-- Admin sees Home on admin_dashboard.php -->
                            <li><a href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="admin_dashboard.php">Dashboard</a></li> <!-- Admin sees Dashboard on index.php -->
                            <li><a href="logout.php">Logout</a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Normal user: Show Dashboard and Logout -->
                        <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php'): ?>
                            <li><a href="index.php">Home</a></li> <!-- User sees Home on dashboard.php -->
                            <li><a href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="dashboard.php">Dashboard</a></li> <!-- User sees Dashboard on index.php -->
                            <li><a href="logout.php">Logout</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- If no user is logged in -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
