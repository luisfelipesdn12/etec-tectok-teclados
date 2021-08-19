<section class="p-5">
    <h1 class="mb-4">
        Destaques
    </h1>
    <div class="row" style="row-gap: 20px;">
        <?php
        include __DIR__ . '/../database.php';

        try {
            $products = get_products();

            if (empty($products)) {
                echo '<p class="text-secondary fs-5">Não há nenhum produto.</p>';
            } else {
                foreach ($products as $product) {
                    echo '
                    <div class="col-sm-3 bg-dark rounded p-2">
                        <img src="' . $product['image_url'] . '" class="img-responsive rounded w-100">
                        <div class="px-2">
                            <p class="fs-4 fw-bolder mb-2 mt-3">
                                ' . $product['name'] . '
                            </p>
                            <p class="m-0">
                                ' . $product['description'] . '
                            </p>
                            <p class="fs-5 fw-bolder my-2" style="color: var(--pink);">
                                R$ ' . number_format($product['price'], 2, ',', '.') . '
                            </p>
                        </div>
                    </div>
                    ';
                }
            }
        } catch (\Exception $e) {
            echo '<script>console.error(' . json_encode($e->getMessage()) . ')</script>';
            echo '<p class="text-secondary fs-5">Ocorreu um erro ao se conectar com o banco de dados.</p>';
        }
        ?>
    </div>
</section>
