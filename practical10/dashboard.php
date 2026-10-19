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

$_SESSION["last_activity"] = time();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>

<h2>Welcome to Student Dashboard</h2>

<p>
Hello,
<?php echo htmlspecialchars($_SESSION["username"]); ?>!
</p>

<p>You are logged in successfully.</p>

<a href="logout.php">Logout</a>

</body>
</html>