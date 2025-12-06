<?php
// login.php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['user_type'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($userType === '' || $email === '' || $password === '') {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, name, email, password_hash, user_type FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result || $result->num_rows === 0) {
        echo "<script>alert('No account found with that email. Please sign up first.'); window.history.back();</script>";
        exit;
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password_hash'])) {
        echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        exit;
    }

    if ($userType !== $user['user_type']) {
        echo "<script>alert('You selected the wrong user type.'); window.history.back();</script>";
        exit;
    }

    // Login OK → store session
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_type'] = $user['user_type'];

    // Redirect based on role
    if ($user['user_type'] === 'admin') {
        $redirect = 'admin.php';
    } elseif ($user['user_type'] === 'volunteer') {
        $redirect = 'dashboard.php';
    } else {
        $redirect = 'index.html';
    }

    echo "<script>alert('Login successful!'); window.location.href='$redirect';</script>";
    exit;
} else {
    header('Location: login.html');
    exit;
}
