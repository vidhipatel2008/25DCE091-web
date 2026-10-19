<?php
require "db.php";

$users = [
    ["student1", "Student@123", "student"],
    ["admin1", "Admin@123", "admin"]
];

foreach ($users as $user) {
    $username = $user[0];
    $password = password_hash($user[1], PASSWORD_DEFAULT);
    $role = $user[2];

    $sql = "INSERT IGNORE INTO login_users
            (username, password, role) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $stmt->close();
}

echo "Sample users created successfully!";
$conn->close();
?>