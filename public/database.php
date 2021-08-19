<?php

function get_database_connection()
{
    $engine = getenv("DB_ENGINE") ?: "mysql";
    $host = getenv("DB_HOST") ?: "localhost";
    $name = getenv("DB_NAME") ?: "etec_tectok_teclados";
    $user = getenv("DB_USER");
    $password = getenv("DB_PASSWORD");

    if ($user == false or $password == false) {
        echo "The environment variables `DB_USER` and `DB_PASSWORD` are required.";
        throw new Exception("The environment variables `DB_USER` and `DB_PASSWORD` are required.");
    }

    return new PDO("$engine:host=$host;dbname=$name", $user, $password);
}

function get_products()
{
    $connection = get_database_connection();
    $products = $connection->query('select * from product_with_category')->fetchAll();

    return $products;
}
