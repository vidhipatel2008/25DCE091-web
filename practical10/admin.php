<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (time() - $_SESSION["last_activity"] > 300) {
    $_SESSION = [];
    session_destroy();

    header("Location: login.php?timeout=1");
    exit;
}

if ($_SESSION["role"] != "admin") {
    header("Location: dashboard.php");
    exit;
}

$_SESSION["last_activity"] = time();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Welcome to Admin Dashboard</h2>

<p>Administrator access granted.</p>

<a href="logout.php">Logout</a>

</body>
</html>