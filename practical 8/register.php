<?php
require "db.php";
$name = "Amit Shah";
$email = "amit@gmail.com";
$sql = "INSERT INTO students (name, email) VALUES (:name, :email)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name' => $name,
    ':email' => $email
]);
echo "Student registered successfully!";
?>