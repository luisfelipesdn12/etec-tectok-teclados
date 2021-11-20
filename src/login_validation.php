<?php

include __DIR__ . '/database.php';

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$redirect_to = $_POST['redirect_to'] ?? '/';

if (filter_var($redirect_to, FILTER_VALIDATE_URL)) {
    $redirect_to = '/';
}

$user = $db->get_user_by_email($user_email);

if ($user) {
    // Check password
    if ($user['password'] == $user_password) {
        session_start();
        $_SESSION['user'] = $user;
        header("Location: $redirect_to");
    } else {
        header("Location: /login.php?wrong_password_error=1");
    }
} else {
    header("Location: /login.php?invalid_email_error=1");
}
