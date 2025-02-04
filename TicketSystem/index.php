<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // If not logged in, redirect to login
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <div class="dashboard">
            <p>You are logged in as a <strong><?php echo $_SESSION['role']; ?></strong>.</p>
            
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="view_tickets.php" class="button">View Tickets</a>
            <?php endif; ?>
            
            <a href="submit_ticket.php" class="button">Submit a Ticket</a>
        </div>

        <a href="logout.php" class="button logout">Logout</a>
    </div>
</body>
</html>
