<?php
session_start();
require "db.php";

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT id, username, password, role
            FROM login_users WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {

        $stmt->bind_result($id, $dbUsername, $dbPassword, $role);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {

            session_regenerate_id(true);

            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $dbUsername;
            $_SESSION["role"] = $role;
            $_SESSION["last_activity"] = time();

            if ($role == "admin") {
                header("Location: admin.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;

        } else {
            $error = "Invalid username or password.";
        }

    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Login</title>
</head>
<body>

<h2>Login Form</h2>

<p><?php echo htmlspecialchars($error); ?></p>

<form method="POST" action="login.php">

    Username:
    <input type="text" name="username" required>
    <br><br>

    Password:
    <input type="password" name="password" required>
    <br><br>

    <button type="submit">Login</button>

</form>

</body>
</html>