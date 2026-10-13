```php
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize input
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $message = trim($_POST["message"] ?? "");

    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $mobile = htmlspecialchars($mobile);
    $course = htmlspecialchars($course);
    $message = htmlspecialchars($message);

    // Validation
    $errors = [];

    if ($name == "") {
        $errors[] = "Name is required.";
    } elseif (!preg_match("/^[A-Za-z ]{3,50}$/", $name)) {
        $errors[] = "Enter a valid name.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email.";
    }

    if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) {
        $errors[] = "Enter a valid 10-digit mobile number.";
    }

    if ($course == "") {
        $errors[] = "Please select a course.";
    }

    // Display errors
    if (!empty($errors)) {

        echo "<h2>Form Submission Failed</h2>";

        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }

    } else {

        // Store data in CSV
        $file = "students.csv";

        $fp = fopen($file, "a");

        if ($fp) {

            fputcsv($fp, [
                $name,
                $email,
                $mobile,
                $course,
                $message
            ]);

            fclose($fp);

            echo "<h2>Registration Successful!</h2>";
            echo "<p>Your details have been saved successfully.</p>";

        } else {

            echo "<h2>Error!</h2>";
            echo "<p>Unable to save the data.</p>";
        }
    }

} else {

    echo "Invalid request.";
}

?>
```
