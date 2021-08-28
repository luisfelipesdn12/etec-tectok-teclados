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
    <?php
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        try {
            $category = get_category_by_id($category_id);
            $products = get_products_from_category_id($category_id);

            if (isset($category)) { ?>
                <section class="p-5">
                    <h1 class="mb-4">
                        <?php echo $category['name'] ?>
                    </h1>
                    <div class="row" style="row-gap: 20px;"><?php
                        if (empty($products)) {
                            $category_name = $category['name'];
                            render_error("Não há nenhum produto na categoria $category_name.");
                        } else {
                            render_products($products);
                        }
                    ?></div>
                </section>
    <?php }
        } catch (Exception $e) {
            render_error("Ocorreu um erro ao se conectar com o banco de dados.", $e);
        }
    }
    ?>
    <?php include 'includes/products.php'; ?>
    <?php include 'includes/footer.html'; ?>
</body>

</html>