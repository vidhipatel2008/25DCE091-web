<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    if (!preg_match("/^[a-zA-Z0-9_]{3,50}$/", $username)) {
        die("Invalid username.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($email) > 100) {
        die("Invalid email address.");
    }
    if (strlen($password) < 8) {
        die("Password must contain at least 8 characters.");
    }
    $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->close();
        die("Username or email already exists.");
    }
    $stmt->close();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Registration failed. Please try again.";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Please submit the registration form.";
}
?>