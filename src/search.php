<!DOCTYPE html>
<html lang="pt-BR">
<?php session_start(); ?>
<?php include __DIR__ . '/database.php'; ?>
<?php include __DIR__ . '/utils.php'; ?>

<head>
    <?php include 'includes/seo.html' ?>
    <?php include 'includes/imports.html' ?>
</head>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/header.html'; ?>
    <?php
    if (isset($_GET['q'])) {
        $query = $_GET['q'];
        try {
            $products = $db->get_products_from_search_term($query, "id, image_url, name, description, price, quantity_available");
        ?>
                <section class="p-5">
                    <h1 class="mb-4">
                        Resultado da Busca
                    </h1>
                    <div class="row" style="row-gap: 20px;"><?php
                        if (empty($products)) {
                            render_error("Não há nenhum produto como resultado.");
                        } else {
                            render_products($products);
                        }
                    ?></div>
                </section>
    <?php } catch (Exception $e) {
            render_error("Ocorreu um erro ao se conectar com o banco de dados.", $e);
        }
    }
    ?>
    <?php include 'includes/products.php'; ?>
    <?php include 'includes/footer.html'; ?>
</body>

</html>
