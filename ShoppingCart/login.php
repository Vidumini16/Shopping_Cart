<?php 
session_start();
include 'db.php';

$emailError = $passwordError = '';
$email = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Validate email
    if (empty($email)) {
        $emailError = 'Email is required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Invalid email format!';
    }

    // Validate password
    if (empty($password)) {
        $passwordError = 'Password is required!';
    }

    if (empty($emailError) && empty($passwordError)) {
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $id;
                $_SESSION["name"] = $name;
                header("Location: blog.php");
                exit;
            } else {
                $passwordError = 'Invalid Password!';
            }
        } else {
            $emailError = 'User not found!';
        }
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        
        <form method="post" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" 
                    class="w-full px-4 py-2 border <?php echo $emailError ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if ($emailError): ?>
                    <p class="text-red-500 text-sm"><?php echo $emailError; ?></p>
                <?php endif; ?>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-2 border <?php echo $passwordError ? 'border-red-500' : 'border-gray-300'; ?> rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if ($passwordError): ?>
                    <p class="text-red-500 text-sm"><?php echo $passwordError; ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Login
            </button>
        </form>
        
        <p class="text-center mt-4 text-sm text-gray-600">Don't have an account? <a href="register.php" class="text-blue-500 hover:text-blue-700">Register Here</a></p>
    </div>
</div>
