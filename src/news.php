<!DOCTYPE html>
<html lang="pt-BR">
<?php include __DIR__ . '/database.php'; ?>
<?php include __DIR__ . '/utils.php'; ?>

<head>
    <?php include 'includes/seo.html' ?>
    <?php include 'includes/imports.html' ?>
</head>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/header.html'; ?>
    <section class="p-5">
        <h1 class="mb-4">
            Novidades
        </h1>
        <div class="row" style="row-gap: 20px;">
            <?php
            try {
                $products = get_only_new_products();

                if (empty($products)) {
                    render_error("Não há nenhum produto.");
                } else {
                    render_products($products);
                }
            } catch (Exception $e) {
                render_error("Ocorreu um erro ao se conectar com o banco de dados.", $e);
            } ?>
        </div>
    </section>
    <?php include 'includes/products.php'; ?>
    <?php include 'includes/footer.html'; ?>
</body>

</html>