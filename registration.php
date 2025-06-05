<?php
session_start();

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        
        try {
            $stmt->execute([$username, $hashed_password]);

            $_SESSION['username'] = $username;  
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
    body {
        background: url('../new/images/enter.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
        font-family: Arial, sans-serif;
    }
    .register-form {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Increased width */
        width: 100%;
        padding: 40px; /* Increased padding */
    }
    .register-form h3 {
        color: #333;
        font-size: 2rem; /* Increased font size */
    }
    .register-form .form-label {
        color: #333;
        font-size: 1.1rem; /* Slightly larger labels */
    }
    .btn-primary {
        background: #6a11cb;
        border: none;
        transition: background 0.3s;
        font-size: 1.1rem; /* Larger button text */
    }
    .btn-primary:hover {
        background: #2575fc;
    }
</style>

</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="register-form card p-4">
            <h3 class="text-center">Register</h3>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="registration.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <a href="login.php">Already have an account? Login here</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
