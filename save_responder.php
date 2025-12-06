<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name     = $_POST['name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $phone         = $_POST['phone'] ?? '';
    $location      = $_POST['location'] ?? '';
    $license_no    = $_POST['skills'] ?? '';        // your textarea "License No"
    $preferredTime = $_POST['preferredTime'] ?? '';
    $password      = $_POST['password'] ?? '';

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload (certificate)
    $certificate_path = null;
    if (!empty($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName   = time() . '_' . basename($_FILES['uploadFile']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $targetPath)) {
            $certificate_path = $targetPath;
        }
    }

    $stmt = $conn->prepare("
        INSERT INTO responders 
        (full_name, email, phone, location, license_no, certificate_path, preferred_time, password_hash)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssssssss",
        $full_name,
        $email,
        $phone,
        $location,
        $license_no,
        $certificate_path,
        $preferredTime,
        $password_hash
    );

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
