<!DOCTYPE html>
<html lang="pt-BR">
<?php

session_start();
include  __DIR__ . '/database.php';
include __DIR__ . '/utils.php';

if (!is_logged_in()) {
    header("Location: /login.php?redirect_to=" . $_SERVER['REQUEST_URI']);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity_ordered = $_POST['quantity_ordered'] ?? 1;

    // If the product is not in the cart yet,
    // or it is but the quantity is not incremental,
    // set the quantity exactly to the value specified.
    if (!isset($_SESSION['cart'][$product_id]) || !($_POST['incremental'] == 'true')) {
        $_SESSION['cart'][$product_id] = $quantity_ordered;
    } else {
        // If the product is in the cart and the quantity
        // is incremental, increment the quantity by the
        // value specified.
        $_SESSION['cart'][$product_id] += $quantity_ordered;
    }

    // The maximum quantity is the quantity available.
    $product = $db->get_product_by_id($product_id);
    if ($_SESSION['cart'][$product_id] > $product['quantity_available']) {
        $_SESSION['cart'][$product_id] = $product['quantity_available'];
    }
}

?>

<head>
    <?php

    include 'includes/seo.html';
    include 'includes/imports.html';

    ?>
</head>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php

    include 'includes/navbar.php';
    include 'includes/header.html';

    ?>
    <section class="p-5">
        <h1 class="mb-4">
            Produtos Adicionados
        </h1>
        <div class="row" style="row-gap: 20px;">
            <?php

            try {
                $products = array();

                foreach ($_SESSION['cart'] as $product_id => $quantity_ordered) {
                    $product = $db->get_product_by_id($product_id);
                    $product['quantity_ordered'] = $quantity_ordered;
                    $products[] = $product;
                }

                if (empty($products)) {
                    render_error("Não há nenhum produto adicionado ainda.");
                } else {
                    render_shopping_cart_products($products);
                }
            } catch (Exception $e) {
                render_error("Ocorreu um erro ao se conectar com o banco de dados.", $e);
            } ?>
        </div>
        <h1 class="mt-4">
            Total: R$ <?php echo number_format(get_total_price($products), 2, ',', '.'); ?>
        </h1>
        <button class="btn" id="continue-shopping-btn" onclick="location.href='/'">
            Continuar Comprando
        </button>
        <button class="btn" id="checkout-btn" <?= !empty($products) ?: 'disabled' ?>>
            Finalizar Compra
        </button>
    </section>
    <?php

    include 'includes/footer.html';

    ?>
</body>

</html>
