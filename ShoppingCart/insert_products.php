<?php
include 'db.php';

// Ensure 'uploads/' directory exists
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

// Insert sample products (Ensure images exist in 'uploads/' folder)
$products = [
    ["Black Dress", 2550.99, "uploads/blackfrock.jpg"],
	["Brown Dress", 3900.99, "uploads/brownDress.jpg"],
	["Red Dress", 1800.89, "uploads/redDress.jpg"],
	["Zenana Smoke Dress", 4800.89, "uploads/smokeDress.jpg"],
    ["Finley Polo Dress", 2600.89, "uploads/poloDress.jpg"],
	["Stripe Midi Dress", 3800.89, "uploads/midiDress.jpg"],
   
   
];

foreach ($products as $product) {
    $name = $product[0];
    $price = $product[1];
    $image = $product[2];

    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image);
    $stmt->execute();
}

echo "Products added successfully!";
?>
