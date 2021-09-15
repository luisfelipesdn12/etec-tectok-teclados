<?php

function render_error($message, Exception $e = null)
{
    if ($e) { ?>
        <script>
            console.error(<?php echo json_encode($e->getMessage()) ?>)
        </script>
    <?php }

    if ($message) { ?>
        <p class="text-secondary fs-5 m-0">
            <?php echo $message ?>
        </p>
    <?php }
}

function render_product($product)
{ ?>
    <div class="product-card col-sm-3 bg-dark rounded p-2">
        <div class="product-image-container bg-secondary bg-opacity-25" style="background-image: url(<?php echo $product['image_url'] ?>);"></div>
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
                <button class="btn-product btn btn-dark w-100 d-flex justify-content-center align-items-center my-2" <?php echo $product['quantity_available'] > 0 ? "" : "disabled" ?>>
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

function render_products($products)
{
    foreach ($products as $product) {
        render_product($product);
    }
}
