<?php
session_start();
require 'config/db.php'; // your database connection file

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch visit history for this user
$sql = "SELECT * FROM visit_requests WHERE user_id = ? ORDER BY visit_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visit History</title>
</head>
<body>

<header>
    <h1>Visit History for <?php echo $_SESSION['username']; ?></h1>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="logout.php">Logout</a>
    </nav>
    <hr>
</header>

<section>
    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Visit ID</th>
                <th>Visit Date</th>
                <th>Status</th>
                <th>QR Code</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo date("M d, Y H:i A", strtotime($row['visit_date'])); ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                    <td>
                        <?php if($row['status'] == 'approved') echo "✅ Active"; else echo "❌ Inactive"; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No visit requests found.</p>
    <?php endif; ?>
</section>

</body>
</html>