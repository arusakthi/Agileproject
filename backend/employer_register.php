<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $company_name     = $_POST['companyName'] ?? '';
    $email            = $_POST['email'] ?? '';
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirmPassword'] ?? '';
    $location         = $_POST['location'] ?? '';
    $description      = $_POST['description'] ?? '';

    // Validation
    if (empty($company_name) || empty($email) || empty($password)) {
        die("Required fields missing");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO employers 
            (company_name, email, password, location, description)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $company_name,
        $email,
        $hashed_password,
        $location,
        $description
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "Employer registered successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
