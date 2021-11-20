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

        #product-info-container button.btn {
            width: 10rem;
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--black);
            background-color: var(--blue);
            margin: 0.1rem 0;
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

            #product-info-container button.btn {
                width: 100%;
            }
        }
    </style>

    <script>
        let deleteConfirmModal = document.getElementById('deleteConfirmModal');
    </script>
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

            if (!filter_var($product['image_url'], FILTER_VALIDATE_URL)) {
                $product['image_url'] = '/assets/products/' . $product['image_url'];
            }

            if (isset($product)) { ?>
                <div class="modal fade" id="deleteConfirmModal" aria-hidden="true" aria-labelledby="deleteConfirmModalLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered" style="width: max-content;">
                        <div class="bg-dark modal-content">
                            <div class="modal-body">
                                <p>Tem certeza que deseja excluir este item?</p>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary px-4" style="background: var(--pink); border: none;" onclick="location.href='/admin/delete_validation.php?product_id=<?= $product_id; ?>'">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="p-5">
                    <div id="product-details-container">
                        <div id="product-display-container">
                            <div class="product-image-container bg-secondary bg-opacity-25" style="background-image: url(<?= $product['image_url'] ?>);"></div>
                        </div>
                        <div id="product-info-container">
                            <h1 class="mb-4">
                                <?= $product['name'] ?>
                            </h1>
                            <p class="fs-5">
                                <?= $product['description'] ?>
                            </p>
                            <p class="fs-4 fw-bolder m-0" style="color: var(--pink);">
                                R$ <?= number_format($product['price'], 2, ',', '.') ?>
                            </p>
                            <p class="text-muted">
                                <?= $product['quantity_available'] ?> unidades disponíveis
                            </p>

                            <form action="shopping.php" method="post">
                                <input type="text" name="product_id" value="<?= $product['id'] ?>" readonly hidden>
                                <input type="number" name="quantity_ordered" value=1 min=1 read<input type="text" name="product_id" value="<?= $product['id'] ?>" readonly hidden>
                                <input name="incremental" value="true" hidden readonly>
                                <button type="submit" class="btn" <?= $product['quantity_available'] > 0 ? "" : "disabled" ?>>
                                    <?= $product['quantity_available'] > 0 ? 'Comprar' : 'Indisponível' ?>
                                </button>
                            </form>


                            <?php if (is_admin()) { ?>
                                <div>
                                    <p class="text-muted mt-4 mb-1">
                                        Funções Administrativas:
                                    </p>
                                    <button class="btn" style="background-color: var(--white);" onclick="location.href='/admin/edit.php?product_id=<?= $product_id; ?>'">
                                        Alterar
                                    </button>
                                    <button class="btn" style="background-color: var(--pink);" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                        Excluir
                                    </button>
                                </div>
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
