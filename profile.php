<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>

<h2>User Profile</h2>

<p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
<p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>