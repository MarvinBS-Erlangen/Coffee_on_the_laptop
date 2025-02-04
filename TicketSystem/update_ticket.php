<?php
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // If not admin, redirect to index
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $ticket_id = $_GET['id'];
    $new_status = $_GET['status'];

    // Validate status
    if (!in_array($new_status, ['In Progress', 'closed'])) {
        die("Invalid status.");
    }

    $conn = new mysqli('localhost', 'root', '', 'ticket_system');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the ticket status
    $stmt = $conn->prepare("UPDATE tickets SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $ticket_id);

    if ($stmt->execute()) {
        echo "<p>Ticket status updated successfully!</p>";
    } else {
        echo "<p>Error updating ticket status: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
    
    // Redirect back to the tickets page
    header('Location: view_tickets.php');
    exit();
} else {
    echo "Invalid request.";
}
?>
