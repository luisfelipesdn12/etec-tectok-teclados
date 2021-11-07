<?php

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../database.php';
include __DIR__ . '/../utils.php';

session_start();
if (!is_admin()) {
    header("Location: /");
}

use Hidehalo\Nanoid\Client as NanoId;

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$price = str_replace(',', '.', str_replace('.', '', $_POST['price']));
$description = $_POST['description'];
$quantity_available = $_POST['quantity_available'];
$image_url = $_POST['image_url'];
$category_id = $_POST['category_id'];
$is_new = $_POST['is_new'] == 'on' ? 1 : 0;
$image_source_type = $_POST['image_source_type'];
$edit_image = $_POST['edit_image'] == 'on' ? true : false;

if ($edit_image) {
    $nano_id = new NanoId();

    if ($image_source_type == 'local') {
        $file = new \Verot\Upload\Upload($_FILES['product_image']);

        if ($file->uploaded) {
            $file->file_new_name_body = $nano_id->generateId();

            $file->process(__DIR__ . '/../assets/products/');
            if ($file->processed) {
                $image_url = $file->file_dst_name;
                $file->clean();
            } else {
                header('Location: /admin/edit.php?error_image_process=1');
                die();
            }
        }
    }
}

try {
    $db->edit_product($product_id, $name, $price, $description, $quantity_available, $category_id, $is_new, $edit_image, $image_url);
} catch (Exception $e) {
    header('Location: /admin/edit.php?error_db_insert=1');
    throw $e;
    die();
}

header("Location: /details.php?product_id=$product_id");
