<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in and user_id is stored in session

    // Include the database connection
    include 'connection.php';

    // Insert new ticket
    $stmt = $conn->prepare("INSERT INTO tickets (title, description, user_id, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ssi", $title, $description, $user_id);

    if ($stmt->execute()) {
        echo "<p class='success'>Ticket submitted successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
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
    <title>Submit a Ticket</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            text-align: center;
            color: #333;
        }
        .container label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .container input[type="text"],
        .container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submit a Ticket</h1>
        <form action="submit_ticket.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <input type="submit" value="Submit Ticket">
        </form>
    </div>
</body>
</html>