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
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function get_products($fields = "*")
    {
        $products = $this->connection->query("select $fields from product_with_category")->fetchAll();
        return $products;
    }

    function get_product_by_id($id, $fields = "*")
    {
        $query = $this->connection->prepare("select $fields from product where id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $product = $query->fetch();
        return $product;
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
        $products = $query->fetchAll();
        return $products;
    }

    function get_categories($fields = "*")
    {
        $categories = $this->connection->query("select $fields from category")->fetchAll();
        return $categories;
    }

    function get_category_by_id($id, $fields = "*")
    {
        $query = $this->connection->prepare("select $fields from category where id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $category = $query->fetch();
        return $category;
    }

    function get_users($fields = "*")
    {
        $users = $this->connection->query("select $fields from user")->fetchAll();
        return $users;
    }

    function get_user_by_email($email, $fields = "*")
    {
        $query = $this->connection->prepare("select $fields from user where email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $user = $query->fetch();
        return $user;
    }

    function get_user_by_id($id, $fields = "*")
    {
        $query = $this->connection->prepare("select $fields from user where id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $user = $query->fetch();
        return $user;
    }

    function create_user($name, $email, $password, $cep, $address_number)
    {
        $query = $this->connection->prepare("insert into user values (default, :name, :email, :password, default, :cep, :address_number)");

        $cep = str_replace("-", "", $cep);

        $query->bindParam(":name", $name);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->bindParam(":cep", $cep);
        $query->bindParam(":address_number", $address_number);
        $query->execute();
    }
}

try {
    $db = new DatabaseConnection();
} catch (\Throwable $th) {
    header("Location: /database_connection_error.php");
}
