<?php

include __DIR__ . '/database.php';

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

echo "email: $user_email - senha: $user_password <br>";

$user = $db->get_user_by_email($user_email);

if ($user) {
    echo "EXISTE usuário cadastrado com esse email <br>";
    echo $user['password'] == $user_password ? "Senha correta <br>" : "Senha incorreta <br>";
} else {
    echo "NÃO EXISTE usuário cadastrado com esse email <br>";
}
