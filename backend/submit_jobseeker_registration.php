<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $full_name        = $_POST['name'] ?? '';
    $email            = $_POST['email'] ?? '';
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirmPassword'] ?? '';
    $location         = $_POST['location'] ?? '';
    $skills           = $_POST['skills'] ?? '';

    // Basic validation
    if (
        empty($full_name) || empty($email) || empty($password) ||
        empty($location) || empty($skills)
    ) {
        die("All fields are required");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO job_seekers
            (full_name, email, password, location, skills)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $full_name,
        $email,
        $hashed_password,
        $location,
        $skills
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Job seeker registered successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
