<?php

function render_error($message, Exception $e = null)
{
    if ($e) { ?>
        <script>
            console.error(<?= json_encode($e->getMessage()) ?>)
        </script>
    <?php }

    if ($message) { ?>
        <p class="text-secondary fs-5 m-0">
            <?= $message ?>
        </p>
    <?php }
}

function render_product($product)
{
    if (!filter_var($product['image_url'], FILTER_VALIDATE_URL)) {
        $product['image_url'] = '/assets/products/' . $product['image_url'];
    }

    ?>
    <div class="product-card col-sm-3 bg-dark rounded p-2">
        <div class="product-image-container bg-secondary bg-opacity-25" style="background-image: url(<?= $product['image_url'] ?>);"></div>
        <div class="px-2 pb-2">
            <div>
                <p class="fs-4 fw-bolder mb-2 mt-3">
                    <?= $product['name'] ?>
                </p>
                <p class="m-0">
                    <?= $product['description'] ?>
                </p>
                <p class="fs-5 fw-bolder my-2" style="color: var(--pink);">
                    R$ <?= number_format($product['price'], 2, ',', '.') ?>
                </p>
            </div>
            <hr>
            <div>
                <button class="btn btn-dark w-100 d-flex justify-content-center align-items-center my-2" onclick="location.href='<?= 'details.php?product_id=' . $product['id']; ?>'">
                    <span class="material-icons-outlined">
                        info
                    </span>
                    <p class="m-0 px-2">
                        Detalhes
                    </p>
                </button>
                <form action="shopping.php" method="post">
                    <input type="text" name="product_id" value="<?= $product['id'] ?>" readonly hidden>
                    <input type="number" name="quantity_ordered" value=1 min=1 read<input type="text" name="product_id" value="<?= $product['id'] ?>" readonly hidden>
                    <input name="incremental" value="true" hidden readonly>
                    <button type="submit" class="btn product-buy-btn w-100 d-flex justify-content-center align-items-center my-2" <?= $product['quantity_available'] > 0 ? "" : "disabled" ?>>
                        <span class="material-icons-outlined">
                            <?= $product['quantity_available'] > 0 ? "attach_money" : "money_off" ?>
                        </span>
                        <p class="m-0 px-2">
                            <?= $product['quantity_available'] > 0 ? "Comprar" : "Indisponível" ?>
                        </p>
                    </button>
                </form>
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

function render_shopping_cart_product($product)
{
    if (!filter_var($product['image_url'], FILTER_VALIDATE_URL)) {
        $product['image_url'] = '/assets/products/' . $product['image_url'];
    }

?>
    <div class="shopping-cart-product-card bg-dark rounded p-2">
        <div class="product-image-container bg-secondary bg-opacity-25" style="background-image: url(<?= $product['image_url'] ?>);"></div>
        <div class="shopping-cart-product-card-info">
            <div>
                <p class="fs-5 fw-bolder m-0">
                    <?= $product['name'] ?>
                </p>
                <p class="fs-5 fw-bolder mb-2" style="color: var(--pink);">
                    R$ <?= number_format($product['price'], 2, ',', '.') ?>
                </p>
            </div>
            <form action="shopping.php" method="post" class="update-quantity-ordered-form">
                <input type="text" name="product_id" value="<?= $product['id'] ?>" readonly hidden>
                <label for="quantity_ordered" style="color: var(--white);">
                    Quantidade:
                </label>
                <input type="number" name="quantity_ordered" min=1 max=<?= $product['quantity_available'] ?> value="<?= $product['quantity_ordered'] ?>" class="bg-dark form-control quantity-ordered-input" required>
                <button title="Atualizar" type="submit" class="btn material-icons" style="background-color: var(--blue);">
                    send
                </button>
                <button title="Apagar Item" id="delete-product-<?= $product['id'] ?>" class="btn material-icons" style="background-color: var(--pink);">
                    delete
                </button>
            </form>
        </div>
    </div>
    <script>
        const deleteButton = document.getElementById("delete-product-<?= $product['id'] ?>");
        if (deleteButton) {
            deleteButton.onclick = (e) => {
                e.preventDefault();
                location.href = "remove_from_shopping.php?product_id=<?= $product['id'] ?>";
            };
        }
    </script>
<?php }

function render_shopping_cart_products(array $products)
{
    foreach ($products as $product) {
        render_shopping_cart_product($product);
    }
}

function is_logged_in()
{
    return !empty($_SESSION['user']);
}

function is_admin()
{
    return is_logged_in() && $_SESSION['user']['type'] == 'admin';
}

function get_total_price(array $products)
{
    $total = 0;
    foreach ($products as $product) {
        $total += $product['price'] * $product['quantity_ordered'];
    }
    return $total;
}
