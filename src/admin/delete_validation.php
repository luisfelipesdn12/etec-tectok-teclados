<?php

include __DIR__ . '/../database.php';
include __DIR__ . '/../utils.php';

session_start();
if (!is_admin()) {
    header("Location: /");
}

$product_id = $_GET['product_id'];

$db->delete_product($product_id);
header('Location: /admin');
