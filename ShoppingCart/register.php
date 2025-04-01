<?php
session_start();
include 'db.php';

$nameError = $emailError = $passwordError = '';
$name = $email = $password = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    
    // Validate Name
    if (empty($name)) {
        $nameError = "Name is required!";
    }

    // Validate Email
    if (empty($email)) {
        $emailError = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format!";
    } else {
        // Check if email already exists in database
        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();
        
        if ($checkEmail->num_rows > 0) {
            $emailError = "Email already registered!";
        }
    }

    // Validate Password
    if (empty($password)) {
        $passwordError = "Password is required!";
    } elseif (strlen($password) < 6) {
        $passwordError = "Password must be at least 6 characters long!";
    }

    // If no errors, insert user into the database
    if (empty($nameError) && empty($emailError) && empty($passwordError)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password securely

        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $passwordHash);

        if ($stmt->execute()) {
            $successMessage = "Registration successful! <a href='login.php' class='text-blue-500 hover:text-blue-700'>Login Here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

        <?php if ($successMessage): ?>
            <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        
        <form method="post" class="space-y-4">
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" 
                    class="w-full px-4 py-2 border <?php echo $nameError ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if ($nameError): ?>
                    <p class="text-red-500 text-sm"><?php echo $nameError; ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" 
                    class="w-full px-4 py-2 border <?php echo $emailError ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if ($emailError): ?>
                    <p class="text-red-500 text-sm"><?php echo $emailError; ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-2 border <?php echo $passwordError ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if ($passwordError): ?>
                    <p class="text-red-500 text-sm"><?php echo $passwordError; ?></p>
                <?php endif; ?>
            </div>
            
            <!-- Register Button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Register
            </button>
        </form>
        
        <p class="text-center mt-4 text-sm text-gray-600">Already have an account? <a href="login.php" class="text-blue-500 hover:text-blue-700">Login Here</a></p>
    </div>
</div>
