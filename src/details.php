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

        button.btn#buy-btn {
            width: 10rem;
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--black);
            background-color: var(--blue);
        }

        @media (max-width: 768px) {
            #product-details-container {
                display: block;
            }

            #product-info-container {
                padding: 2rem 0;
            }

            #product-display-container {
                width: 50%;
            }

        }

        @media (max-width: 450px) {
            #product-display-container {
                width: 100%;
            }

            button.btn#buy-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php

    include 'includes/navbar.php';
    include 'includes/header.html';

    ?>
    <?php
    header("Location: /");

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
                            <p class="fs-5">
                                <?php echo $product['description'] ?>
                            </p>
                            <p class="fs-4 fw-bolder m-0" style="color: var(--pink);">
                                R$ <?php echo number_format($product['price'], 2, ',', '.') ?>
                            </p>
                            <p class="text-muted">
                                <?php echo $product['quantity_available'] ?> unidades disponíveis
                            </p>
                            <button class="btn" id="buy-btn">
                                Comprar
                            </button>
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
