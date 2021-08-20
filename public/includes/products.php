<section class="p-5">
    <h1 class="mb-4">
        Todos os Produtos
    </h1>
    <div class="row" style="row-gap: 20px;">
        <?php

        try {
            $products = get_products();

            if (empty($products)) {
                render_error("Não há nenhum produto.");
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