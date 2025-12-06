<?php
// signup.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit;
    }

    // basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
        exit;
    }

    // check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $check->bind_param("s", $email);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult && $checkResult->num_rows > 0) {
        echo "<script>alert('An account with this email already exists. Please login.'); window.location.href='login.html';</script>";
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $userType     = 'user'; // default for signup

    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $passwordHash, $userType);

    if ($stmt->execute()) {
        echo "<script>alert('Account created successfully! Please login now.'); window.location.href='login.html';</script>";
    } else {
        echo 'Error: ' . $stmt->error;
    }

    exit;
} else {
    header('Location: signup.html');
    exit;
}
