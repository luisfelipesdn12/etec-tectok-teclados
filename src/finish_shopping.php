<!DOCTYPE html>
<html lang="pt-BR">
<?php

require __DIR__ . '/../vendor/autoload.php';
include  __DIR__ . '/database.php';
include __DIR__ . '/utils.php';

use Hidehalo\Nanoid\Client as NanoId;

session_start();
if (!is_logged_in()) {
    header("Location: /login.php?redirect_to=/shopping.php");
    die();
}

if (!isset($_SESSION['cart'])) {
    header("Location: /");
    die();
}

$nano_id = new NanoId();
$ticket = $nano_id->generateId();
$user_id = $_SESSION['user']['id'];

foreach ($_SESSION['cart'] as $product_id => $quantity_ordered) {
    $db->create_sale($ticket, $user_id, $product_id, $quantity_ordered);
}

unset($_SESSION['cart']);

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
    <main style="display: flex; justify-content: center;">
        <div class="card text-center bg-dark my-5 px-5" style="--bs-bg-opacity: .95; max-width: 100rem;">
            <div class="card-header"></div>
            <div class="card-body">
                <h5 class="card-title">Ticket de compra</h5>
                <p class="card-text">
                    Sua compra foi realizada com sucesso!
                    <br>
                    Aqui está seu ticket de compra:
                </p>
                <h2><span class="badge bg-secondary"><?= $ticket ?></span></h2>
            </div>
            <div class="card-footer text-muted"></div>
        </div>
    </main>
    <?php

    include 'includes/footer.html';

    ?>
</body>

</html>
