<?php
session_start();
require_once "config/db.php";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && md5($password) === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>

<!-- HEADER -->
<header>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <nav>
        <a href="profile.php">My Profile</a> |
        <a href="notifications.php">Notifications</a>
    </nav>
    <hr>
</header>

<!-- NOTIFICATIONS SECTION -->
<section id="notifications">
    <h2>Recent Notifications</h2>

    <div class="notification-item">
        <strong>Visit Request Approved</strong> <span>NEW</span>
        <p>Your visit request for Mar 03, 2026 at 12:13 AM has been approved. Your QR code is now active.</p>
        <small>Mar 03, 2026 11:14 AM</small><br>
        <button>Mark as Read</button>
    </div>

    <br>
    <a href="notifications.php">View All Notifications</a>
</section>

<hr>

<!-- QUICK ACTIONS SECTION -->
<section id="quick-actions">
    <h2>Quick Actions</h2>

    <div>
        <h3>Request a Visit</h3>
        <p>Submit a visit request to activate your QR code</p>
        <a href="request_visit.php">Request Visit</a>
    </div>
</section>

<hr>

<!-- VISIT HISTORY -->
<section id="visit-history">
    <h2>Visit History</h2>
    <p>View your past and upcoming visit requests</p>
    <a href="visit_history.php">View Visit History</a>
</section>

<hr>

<!-- LOGOUT -->
<footer>
    <a href="logout.php">Logout</a>
</footer>

</body>
</html>