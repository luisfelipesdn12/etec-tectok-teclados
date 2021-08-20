<?php

function get_database_connection()
{
    $engine = getenv("DB_ENGINE") ?: "mysql";
    $host = getenv("DB_HOST") ?: "localhost";
    $name = getenv("DB_NAME") ?: "etec_tectok_teclados";
    $user = getenv("DB_USER");
    $password = getenv("DB_PASSWORD");

    if ($user == false or $password == false) {
        throw new Exception("The environment variables `DB_USER` and `DB_PASSWORD` are required.");
    }

    return new PDO("$engine:host=$host;dbname=$name", $user, $password);
}

function get_products()
{
    $connection = get_database_connection();
    $products = $connection->query("select * from product_with_category")->fetchAll();
    return $products;
}

function get_products_from_category_id($category_id)
{
    $connection = get_database_connection();

    $products = $connection->query("select * from product_with_category where category_id=$category_id")->fetchAll();
    return $products;
}

function get_categories()
{
    $connection = get_database_connection();
    $categories = $connection->query("select * from category")->fetchAll();

    return $categories;
}

function get_category_by_id($id)
{
    $connection = get_database_connection();
    $category = $connection->query("select * from category where id = $id")->fetch();

    return $category;
}
