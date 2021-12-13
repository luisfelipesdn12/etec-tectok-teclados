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
        // https://stackoverflow.com/a/35375592/12534588
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
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

    function get_products_from_search_term($search_term, $fields = "*")
    {
        // https://stackoverflow.com/a/7357296/12534588
        // $query = $this->connection->prepare("select $fields from product_with_category where name like concat('%', :search_term, '%')");
        $query = $this->connection->prepare("select $fields from product_with_category where name like concat('%', :search_term, '%') or description like concat('%', :search_term, '%');");
        $query->bindParam(":search_term", $search_term);
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

    function create_product($name, $price, $description, $quantity_available, $image_url, $category_id, $is_new)
    {
        $query = $this->connection->prepare("insert into product values (default, :name, :price, :description, :quantity_available, :image_url, :category_id, :is_new)");

        $query->bindParam(":name", $name);
        $query->bindParam(":price", $price);
        $query->bindParam(":description", $description);
        $query->bindParam(":quantity_available", $quantity_available);
        $query->bindParam(":image_url", $image_url);
        $query->bindParam(":category_id", $category_id);
        $query->bindParam(":is_new", $is_new);
        $query->execute();
    }

    function edit_product($product_id, $name, $price, $description, $quantity_available, $category_id, $is_new, $edit_image = false, $image_url = null)
    {
        $query = null;

        if ($edit_image) {
            $query = $this->connection->prepare("update product set name = :name, price = :price, description = :description, quantity_available = :quantity_available, category_id = :category_id, is_new = :is_new, image_url = :image_url where id = :product_id");
            $query->bindParam(":image_url", $image_url);
        } else {
            $query = $this->connection->prepare("update product set name = :name, price = :price, description = :description, quantity_available = :quantity_available, category_id = :category_id, is_new = :is_new where id = :product_id");
        }

        $query->bindParam(":product_id", $product_id);
        $query->bindParam(":name", $name);
        $query->bindParam(":price", $price);
        $query->bindParam(":description", $description);
        $query->bindParam(":quantity_available", $quantity_available);
        $query->bindParam(":category_id", $category_id);
        $query->bindParam(":is_new", $is_new);
        $query->execute();
    }

    function delete_product($product_id)
    {
        $query = $this->connection->prepare("delete from product where id = :product_id");

        $query->bindParam(":product_id", $product_id);
        $query->execute();
    }

    function create_sale($ticket, $user_id, $product_id, $quantity_ordered)
    {
        $query = $this->connection->prepare("insert into sale (ticket, user_id, product_id, quantity_ordered) values (:ticket, :user_id, :product_id, :quantity_ordered)");

        $query->bindParam(":ticket", $ticket);
        $query->bindParam(":user_id", $user_id);
        $query->bindParam(":product_id", $product_id);
        $query->bindParam(":quantity_ordered", $quantity_ordered);

        $query->execute();
    }
}

try {
    $db = new DatabaseConnection();
} catch (\Throwable $th) {
    header("Location: /database_connection_error.php");
}
