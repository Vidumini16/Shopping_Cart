<?php
session_start();
include 'db.php';

$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-10">
<h2 class="text-3xl font-bold text-gray-900 uppercase tracking-wide flex justify-center items-center py-1 ">
    Casual Dresses
</h2>
<a href="blog.php" class="btn bg-rose-200 text-gray-800 hover:bg-rose-300 px-4 py-2 rounded">
    Dashboard
</a>


    <div class="grid grid-cols-3 gap-4 ">
        <?php while ($row = $products->fetch_assoc()): ?>
            <div class="bg-white p-3 shadow rounded">
                <img src="<?php echo $row['image']; ?>" alt="Product Image" class="w-full h-54 object-cover">
                <h4 class="text-xl font-semibold"><?php echo $row['name']; ?></h4>
                <p class="text-lg font-bold">LKR<?php echo $row['price']; ?></p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" 
                    class="mt-3 w-full flex items-center justify-center bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition">
                    🛒 Add to Cart
                </button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
