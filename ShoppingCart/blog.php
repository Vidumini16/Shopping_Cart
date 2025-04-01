<?php
session_start();
include 'db.php';

// Ensure user is logged in
$user_id = $_SESSION['user_id'] ?? null;
$user_name = $_SESSION['name'] ?? 'Guest';
if (!$user_id) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit;
}

// Handle Post Deletion
if (isset($_GET['delete'])) {
    $post_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    header("Location: blog.php");
    exit;
}

// Handle Post Editing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_post'])) {
    $post_id = intval($_POST['post_id']);
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $content, $post_id, $user_id);
    $stmt->execute();
    header("Location: blog.php");
    exit;
}

// Fetch all posts
$posts = $conn->query("SELECT posts.*, users.name FROM posts 
                       JOIN users ON posts.user_id = users.id 
                       ORDER BY posts.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Blog Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-gray-200 p-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Welcome, <?php echo $user_name; ?>!</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <h2 class="text-2xl font-bold flex justify-center items-center py-1">All Blog Posts</h2>
    <a href="dashboard.php" class="btn btn-primary">Create New Blog</a>
    <a href="products.php" class="btn btn-primary ml-auto">Shopping Cart</a>


    <?php while ($row = $posts->fetch_assoc()): ?>
        <div class="bg-white p-4 shadow rounded my-3">
            <h4 class="text-xl font-semibold"><?php echo $row['title']; ?></h4>
            <p><?php echo $row['content']; ?></p>
            <small class="text-gray-500">Posted by <?php echo $row['name']; ?> on <?php echo $row['created_at']; ?></small>
            
            <?php if ($user_id && $row['user_id'] == $user_id): ?>
                <a href="blog.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mt-2">Delete</a>
                <button onclick="editPost(<?php echo $row['id']; ?>, '<?php echo addslashes($row['title']); ?>', '<?php echo addslashes($row['content']); ?>')" class="btn btn-warning btn-sm mt-2">Edit</button>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>

    <!-- Edit Post Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-5 rounded shadow-lg w-96">
            <h3 class="text-xl font-bold">Edit Post</h3>
            <form method="post">
                <input type="hidden" name="post_id" id="edit_post_id">
                <input class="form-control mb-3" type="text" name="title" id="edit_title" required>
                <textarea class="form-control mb-3" name="content" id="edit_content" required></textarea>
                <button type="submit" name="update_post" class="btn btn-primary">Update</button>
                <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editPost(id, title, content) {
            document.getElementById("edit_post_id").value = id;
            document.getElementById("edit_title").value = title;
            document.getElementById("edit_content").value = content;
            document.getElementById("editModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("editModal").classList.add("hidden");
        }
    </script>
</body>
</html>
