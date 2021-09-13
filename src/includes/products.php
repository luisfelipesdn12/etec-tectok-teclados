<section class="p-5">
    <h1 class="mb-4">
        Todos os Produtos
    </h1>
    <div class="row" style="row-gap: 20px;">
        <?php

        try {
            $products = $db->get_products("image_url, name, description, price, quantity_available");

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
