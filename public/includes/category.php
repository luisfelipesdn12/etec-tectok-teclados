<?php

$category_id = $_GET['category_id'];

try {
    $category = get_category_by_id($category_id);
    $products = get_products_from_category_id($category_id);

    if (isset($category)) { ?>
        <section class="p-5">
            <h1 class="mb-4">
                <?php echo $category['name'] ?>
            </h1>
            <div class="row" style="row-gap: 20px;">
                <?php
                try {
                    if (empty($products)) {
                        render_error('Não há nenhum produto na categoria "' . $category['name'] . '".');
                    } else {
                        foreach ($products as $product) {
                            render_product($product);
                        }
                    }
                } catch (Exception $e) {
                    render_error("Ocorreu um erro ao se conectar com o banco de dados.", $e);
                } ?>
            </div>
        </section>
<?php }
} catch (Exception $e) {
}
?>