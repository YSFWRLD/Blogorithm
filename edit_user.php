<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

include('includes/dbconnect.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user data
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo "User not found.";
        exit();
    }
} else {
    echo "No user ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $update_query = "UPDATE users SET username = '$username', role = '$role' WHERE id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>

<h2>Edit User</h2>

<form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br>

    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
    </select><br>

    <button type="submit">Update User</button>
</form>

</body>
</html>
