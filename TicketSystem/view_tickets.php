<?php
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // If not admin, redirect to index
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'ticket_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Modify the SQL query to join tickets with users
$sql = "SELECT tickets.*, users.username FROM tickets
        JOIN users ON tickets.user_id = users.id
        ORDER BY tickets.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Tickets</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Tickets</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Submitted By</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td>" . $row['status'] . "</td>
                            <td>" . $row['created_at'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td class='actions'>
                                <a href='update_ticket.php?id=" . $row['id'] . "&status=In Progress' class='button'>In Progress</a> 
                                <a href='update_ticket.php?id=" . $row['id'] . "&status=closed' class='button'>Closed</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No tickets found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>