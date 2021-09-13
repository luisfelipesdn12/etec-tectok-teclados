<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

class DatabaseConnection
{
    protected PDO $connection;

    function __construct()
    {
        $engine = $_ENV["DB_ENGINE"] ?: "mysql";
        $host = $_ENV["DB_HOST"] ?: "localhost";
        $name = $_ENV["DB_NAME"] ?: "etec_tectok_teclados";
        $user = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASSWORD"];

        if ($user == false or $password == false) {
            throw new Exception("The environment variables `DB_USER` and `DB_PASSWORD` are required.");
        }

        $this->connection = new PDO("$engine:host=$host;dbname=$name;charset=utf8", $user, $password);

        // Prevent SQL inejection with prepare.
        // https://dev.to/butalin/how-i-prevent-sql-injection-in-my-php-code-ijj
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    function get_products($fields = "*")
    {
        $products = $this->connection->query("select $fields from product_with_category")->fetchAll();
        return $products;
    }

    function get_only_new_products($fields = "*")
    {
        $products = $this->connection->query("select $fields from product_with_category where is_new = true")->fetchAll();
        return $products;
    }

    function get_products_from_category_id($category_id, $fields = "*")
    {
        $query = $this->connection->prepare("select $fields from product_with_category where category_id=:category_id");
        $query->bindParam(":category_id", $category_id);
        $query->execute();
        return $query->fetchAll();
    }

    function get_categories($fields = "*")
    {
        $categories = $this->connection->query("select $fields from category")->fetchAll();
        return $categories;
    }

    function get_category_by_id($id, $fields = "*")
    {
        $category = $this->connection->query("select $fields from category where id = $id")->fetch();
        return $category;
    }
}

$db = new DatabaseConnection();
