<?php

session_start();
include  __DIR__ . '/database.php';
include __DIR__ . '/utils.php';

if (!is_logged_in()) {
    header("Location: /login.php?redirect_to=" . $_SERVER['REQUEST_URI']);
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

header("Location: /shopping.php");
