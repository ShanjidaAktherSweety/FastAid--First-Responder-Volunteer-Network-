<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_type = $_POST['request_type'] ?? 'normal';
    $full_name    = $_POST['name'] ?? '';
    $email        = $_POST['email'] ?? '';
    $phone        = $_POST['phone'] ?? '';
    $location     = $_POST['location'] ?? '';
    $description  = $_POST['description'] ?? '';

    $stmt = $conn->prepare("
        INSERT INTO emergency_requests 
        (request_type, full_name, email, phone, location, description)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssssss",
        $request_type,
        $full_name,
        $email,
        $phone,
        $location,
        $description
    );

    if ($stmt->execute()) {
        echo "<script>alert('Your emergency request has been submitted successfully.'); window.location.href='patient.php';</script>";
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
