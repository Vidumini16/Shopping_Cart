<?php
include 'db.php';

// Check if a specific product ID is provided
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Fetch the product image path before deleting
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($image);
    $stmt->fetch();

    // Delete the product from the database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    // Delete the image file from the server
    if ($image && file_exists($image)) {
        unlink($image);
    }

    echo "Product with ID $product_id has been deleted.";
} else {
    // Delete all products if no ID is provided
    $stmt = $conn->query("SELECT image FROM products");
    
    while ($row = $stmt->fetch_assoc()) {
        if (file_exists($row['image'])) {
            unlink($row['image']);
        }
    }

    $conn->query("DELETE FROM products");
    echo "All products have been deleted.";
}
?>
