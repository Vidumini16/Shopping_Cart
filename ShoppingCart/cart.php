<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Add to Cart
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) 
        ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
}

// Fetch Cart Items
$cart_items = $conn->query("SELECT products.id, products.name, products.price, products.image, cart.quantity 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = $user_id");

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-10">
    <h2 class="text-2xl font-bold">Your Shopping Cart</h2>

    <div class="grid grid-cols-1 gap-4">
        <?php while ($item = $cart_items->fetch_assoc()): ?>
            <div class="bg-white p-4 shadow rounded flex items-center">
                <img src="<?php echo $item['image']; ?>" alt="Product Image" class="w-20 h-20 object-cover mr-4">
                <div>
                    <h4 class="text-xl font-semibold"><?php echo $item['name']; ?></h4>
                    <p class="text-lg font-bold">LKR<?php echo $item['price']; ?> x <?php echo $item['quantity']; ?></p>
                    <form method="post" action="remove_cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" name="action" value="remove" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i> Remove
                        </button>
                    </form>
                </div>
            </div>
            <?php $total += ($item['price'] * $item['quantity']); ?>
        <?php endwhile; ?>
    </div>

    <p class="text-xl font-bold mt-4">Total: $<?php echo number_format($total, 2); ?></p>
    <div class="mt-6">
        <a href="products.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
            Continue Shopping
        </a>
    </div>
</body>
</html>









