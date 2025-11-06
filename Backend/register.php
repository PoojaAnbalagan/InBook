<?php
include '../db.php';
session_start();

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone']));

    // Validation
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email) || empty($phone_number)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        // Check if username already exists
        $check_user = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $check_user);
        
        if (mysqli_num_rows($result) > 0) {
            $error = "Username already exists!";
        } else {
            // Check if email already exists
            $check_email = "SELECT * FROM users WHERE email='$email'";
            $result_email = mysqli_query($conn, $check_email);
            
            if (mysqli_num_rows($result_email) > 0) {
                $error = "Email already registered!";
            } else {
                // Insert new user
                $hashed_password = md5($password);
                $sql = "INSERT INTO users (username, password, email, phone_number) VALUES ('$username', '$hashed_password', '$email', '$phone_number')";
                
                if (mysqli_query($conn, $sql)) {
                    $success = "Registration successful! You can now login.";
                    // Optionally redirect to login page after 2 seconds
                    // header("refresh:2;url=login.php");
                } else {
                    $error = "Registration failed! Please try again.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Frontend/Register/Register.css">
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- Left side - Image section -->
        <div class="image-section">
            <div class="content">
                <h1>Welcome!</h1>
                <p>Create your account to get started</p>
            </div>
        </div>

        <!-- Right side - Register form -->
        <div class="login-container">
            <h2>Create Account</h2>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required 
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <input type="tel" name="phone" placeholder="Phone Number" required 
                           value="<?php echo isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : ''; ?>">
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                
                <div class="input-group">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                
                <button type="submit" name="register">Register</button>
            </form>
            
            <div class="register-link">
                Already have an account? <a href="../Frontend/Login/login.html">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>