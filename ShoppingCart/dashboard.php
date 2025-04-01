<?php
session_start();
include 'db.php';

// Ensure user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit;
}

// Handle New Post Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_post'])) {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);
    $stmt->execute();
    
    // Redirect to blog page after post creation
    header("Location: blog.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-gray-200 p-10">
    <h2 class="text-2xl font-bold">Welcome, <?php echo $_SESSION['name']; ?>!</h2>

    <h3 class="mt-4 text-xl font-semibold text-gray-700 border-b-2 border-gray-300 pb-2">Create New Post</h3>

    <form method="post" class="bg-white p-4 shadow rounded">
        <input class="form-control mb-3" type="text" name="title" placeholder="Post Title" required>
        <textarea class="form-control mb-3" name="content" placeholder="Post Content" required></textarea>
        <button type="submit" name="create_post" class="btn btn-primary">Post</button>
    </form>
</body>
</html>
