<?php
include('db.php');
$errorMessage = ''; // Variable to store error message
$successMessage = ''; // Variable to store success message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $sql_check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Email already exists
        $errorMessage = "An account with this email already exists!";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Registration successful!";
        } else {
            $errorMessage = "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <!-- Display error message if exists -->
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Display success message if exists -->
        <?php if (!empty($successMessage)): ?>
            <div class="success-message">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <h2>Create an Account</h2>
            <div>
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Register</button><br><br>
            Already an User? <a href="login.php">Login</a>
        </form>
    </div>
</body>
</html>
