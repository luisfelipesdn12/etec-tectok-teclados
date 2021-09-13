<?php

include __DIR__ . '/database.php';

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$user = $db->get_user_by_email($user_email);

if ($user) {
    // Check password
    if ($user['password'] == $user_password) {
        session_start();
        $_SESSION['user'] = $user;
        header("Location: /" );
    } else {
        header("Location: /login.php?wrong_password_error=1");
    }
} else {
    header("Location: /login.php?invalid_email_error=1");
}
