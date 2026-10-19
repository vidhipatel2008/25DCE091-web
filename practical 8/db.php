<?php
$host = "localhost";
$dbname = "StudentHub";
$user = "root";
$password = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully!";
}
catch (PDOException $e) {
    echo "Database connection failed.";
}
?>