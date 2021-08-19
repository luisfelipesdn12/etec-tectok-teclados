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
                foreach ($products as $product) { ?>
                    <div class="col-sm-3 bg-dark rounded p-2">
                        <img src="<?php echo $product['image_url'] ?>" class="img-responsive rounded w-100">
                        <div class="px-2 pb-2">
                            <div>
                                <p class="fs-4 fw-bolder mb-2 mt-3">
                                    <?php echo $product['name'] ?>
                                </p>
                                <p class="m-0">
                                    <?php echo $product['description'] ?>
                                </p>
                                <p class="fs-5 fw-bolder my-2" style="color: var(--pink);">
                                    R$ <?php echo number_format($product['price'], 2, ',', '.') ?>
                                </p>
                            </div>
                            <hr>
                            <div>
                                <button class="btn-product btn btn-dark w-100 d-flex justify-content-center align-items-center my-2">
                                    <span class="material-icons-outlined">
                                        info
                                    </span>
                                    <p class="m-0 px-2">
                                        Detalhes
                                    </p>
                                </button>
                                <button class="btn-product btn btn-dark w-100 d-flex justify-content-center align-items-center my-2" <?php echo $product['quantity_available'] > 0 ? "" : "disabled" ?> >
                                    <span class="material-icons-outlined">
                                        <?php echo $product['quantity_available'] > 0 ? "attach_money" : "money_off" ?>
                                    </span>
                                    <p class="m-0 px-2">
                                        <?php echo $product['quantity_available'] > 0 ? "Comprar" : "Indisponível" ?>
                                    </p>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php }
            }
        } catch (\Exception $e) {
            echo '<script>console.error(' . json_encode($e->getMessage()) . ')</script>';
            echo '<p class="text-secondary fs-5">Ocorreu um erro ao se conectar com o banco de dados.</p>';
        }
        ?>
    </div>
</section>
