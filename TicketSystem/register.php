<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameUser = $_POST['username'];
    $passwordUser = password_hash($_POST['password'], PASSWORD_DEFAULT);

    include 'connection.php';

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $usernameUser);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<p class='error'>Username already exists. Please choose another one.</p>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $usernameUser, $passwordUser);

        if ($stmt->execute()) {
            echo "<p class='success'>Registration successful!</p>";
        } else {
            echo "<p class='error'>Error: " . $stmt->error . "</p>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">
        </form>
        <div class="login-container">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>