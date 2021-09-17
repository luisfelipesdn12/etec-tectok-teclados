<!DOCTYPE html>
<html lang="pt-BR">
<?php

session_start();
include  __DIR__ . '/database.php';
include __DIR__ . '/utils.php';

?>

<head>
    <?php

    include 'includes/seo.html';
    include 'includes/imports.html';

    ?>

    <style>
        #product-details-container {
            display: flex;
        }

        #product-info-container {
            padding: 0 2rem;
        }

        #product-display-container {
            width: 40%;
        }

        .badge {
            background-color: var(--blue);
        }
    </style>
</head>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php

    include 'includes/navbar.php';
    include 'includes/header.html';

    ?>
    <?php
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        try {
            $product = $db->get_product_by_id($product_id);

            if (isset($product)) { ?>
                <section class="p-5">
                    <div id="product-details-container">
                        <div id="product-display-container">
                            <div class="product-image-container bg-secondary bg-opacity-25" style="background-image: url(<?php echo $product['image_url'] ?>);"></div>
                        </div>
                        <div id="product-info-container">
                            <h1 class="mb-4">
                                <?php echo $product['name'] ?>
                            </h1>
                            <p>
                                <?php echo $product['description'] ?>
                            </p>
                            <p>
                                <?php echo $product['price'] ?>
                            </p>
                            <p>
                                <?php echo $product['quantity_available'] ?> disponíveis
                            </p>
                            <?php if ($product['is_new'] == true) { ?>
                                <h2>
                                    <span class="badge">
                                        Novidade
                                    </span>
                                </h2>
                            <?php } ?>
                        </div>
                    </div>
                </section>
    <?php }
        } catch (Exception $e) {
            render_error("Ocorreu um erro ao se conectar com o banco de dados.", $e);
        }
    }
    ?>
    <?php include 'includes/footer.html'; ?>
</body>

</html>
