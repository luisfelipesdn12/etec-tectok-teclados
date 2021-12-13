<?php

include __DIR__ . '/database.php';

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$user_cep = $_POST['user_cep'];
$user_address_number = $_POST['user_address_number'];
$redirect_to = $_POST['redirect_to'];

// Check if the email is already taken
$existent_user = $db->get_user_by_email($user_email, "id");

if ($existent_user) {
    header("Location: /signup.php?existent_email_error=1");
} else {
    // Insert user in database
    $db->create_user($user_name, $user_email, $user_password, $user_cep, $user_address_number);
    header("Location: /login.php?signup_sucess=1&redirect_to=$redirect_to");
}
