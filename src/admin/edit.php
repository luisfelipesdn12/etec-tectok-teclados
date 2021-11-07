<!DOCTYPE html>
<html lang="pt-BR">

<?php
session_start();
include __DIR__ . '/../database.php';
include __DIR__ . '/../utils.php';

if (!is_admin() || !isset($_GET['product_id'])) {
    header("Location: /");
}

$product = $db->get_product_by_id($_GET['product_id']);

$is_product_image_an_url = filter_var($product['image_url'], FILTER_VALIDATE_URL);

if (!$is_product_image_an_url) {
    $product['image_url'] = '/assets/products/' . $product['image_url'];
}
?>

<head>
    <?php include __DIR__ . '/../includes/seo.html' ?>
    <?php include __DIR__ . '/../includes/imports.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
</head>

<style>
    main a {
        color: var(--pink) !important;
        text-decoration: none !important;
    }

    main a:hover {
        text-decoration: underline !important;
    }

    main button.btn {
        background: var(--pink);
        color: var(--white);
    }

    main button.btn:hover {
        color: var(--white);
    }

    .form-switch .form-check-input {
        background-color: var(--white);
        border-color: rgba(0, 0, 0, 0.25) !important;
    }

    .form-switch .form-check-input:checked {
        background-color: var(--pink);
    }

    .form-switch .form-check-input:focus {
        border-color: rgba(0, 0, 0, 0.25) !important;
        outline: 0;
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba(0,0,0,0.25)'/></svg>");
    }

    #db-error-toast {
        background-color: var(--pink);
        max-width: 330px;
    }

    #product-display-container {
        width: 40%;
    }

    @media (max-width: 768px) {
        #product-display-container {
            width: 50%;
        }
    }

    @media (max-width: 450px) {
        #product-display-container {
            width: 100%;
        }
    }
</style>

<script>
    $(document).ready(() => {
        $('#price').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
</script>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php include __DIR__ . '/../includes/navbar.php'; ?>
    <?php include __DIR__ . '/../includes/header.html'; ?>
    <div class="position-fixed top-0 end-0 p-3 d-flex justify-content-center" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="db-error-toast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center">
                    Erro ao alterar produto ao banco de dados.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php if ($_GET['error_db_insert']) { ?>
        <script>
            const toast = new bootstrap.Toast(document.getElementById("db-error-toast"));
            toast.show();
        </script>
    <?php } ?>

    <main class="p-5">
        <?php if (!$product) { ?>
            <p class="error-message m-0">
                Produto não encontrado.
            </p>
        <?php } ?>
        <h1 class="mb-4">
            Alterar Produto
        </h1>
        <div id="product-display-container">
            <div class="product-image-container bg-secondary bg-opacity-25" style="background-image: url(<?= $product['image_url'] ?>);"></div>
        </div>
        <form method="POST" action="edit_validation.php" enctype="multipart/form-data">
            <h2 class="my-4">
                Informações
            </h2>
            <input type="text" name="product_id" value="<?= $product['id'] ?>" class="d-none">
            <div class="form-floating my-2">
                <input value="<?= $product['name'] ?>" name="name" required maxlength="200" type="text" class="form-control" id="name" placeholder="Nome">
                <label for="name">Nome</label>
            </div>
            <div class="form-floating my-2">
                <input value="<?= number_format($product['price'], 2, ',', '.') ?>" name="price" required type="text" class="form-control" id="price" placeholder="Preço">
                <label for="price">Preço</label>
            </div>
            <div class="form-floating my-2">
                <textarea name="description" required maxlength="2000" type="" class="form-control" id="description" placeholder="Descrição"><?= $product['description'] ?></textarea>
                <label for="description">Descrição</label>
            </div>
            <div class="form-floating my-2">
                <input value="<?= $product['quantity_available'] ?>" name="quantity_available" required type="number" class="form-control" id="quantity_available" placeholder="Quantidade disponível">
                <label for="quantity_available">Quantidade disponível</label>
            </div>
            <div class="form-floating my-2">
                <select value="<?= $product['category_id'] ?>" name="category_id" id="category_id" class="form-select" placeholder="Categoria" required>
                    <?php
                    $categories = $db->get_categories("id, name");

                    foreach ($categories as $category) { ?>
                        <option value="<?= $category['id']; ?>">
                            <?= $category['name']; ?>
                        </option>
                    <?php } ?>
                </select>
                <label for="category_id">Categoria</label>
            </div>
            <div class="form-check form-switch">
                <input <?php if ($product['is_new']) { ?>checked<?php } ?> class="form-check-input" type="checkbox" role="switch" id="is_new" name="is_new">
                <label class="form-check-label text-white" for="is_new">Novidade</label>
            </div>
            <h2 class="my-4">
                Imagem
            </h2>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="edit_image" name="edit_image">
                <label class="form-check-label text-white" for="edit_image">Editar imagem</label>
            </div>
            <?php if ($_GET['error_image_process']) { ?>
                <p class="error-message m-0">
                    Erro ao processar imagem enviada. Tente novamente.
                </p>
            <?php } ?>
            <div id="edit-image-container">
                <div class="form-floating my-2">
                    <select name="image_source_type" id="image_source_type" class="form-select" placeholder="Fonte da imagem" value="url">
                        <?php if ($is_product_image_an_url) { ?>
                            <option value="url">URL da internet</option>
                            <option value="local">Upload de arquivo local</option>
                        <?php } else { ?>
                            <option value="local">Upload de arquivo local</option>
                            <option value="url">URL da internet</option>
                        <?php } ?>
                    </select>
                    <label for="image_source_type">Fonte da imagem</label>
                </div>
                <div class="form-floating my-2" id="image_url_container">
                    <input name="image_url" maxlength="500" type="url" class="form-control" id="image_url" placeholder="URL da imagem" value="<?= $is_product_image_an_url ? $product['image_url'] : '' ?>">
                    <label for="image_url">URL da imagem</label>
                </div>
                <div class="my-2" id="product_image_container">
                    <input name="product_image" type="file" accept="image/*" class="form-control" id="product_image">
                </div>
            </div>
            <button class="my-3 w-100 btn btn-lg fw-bolder" type="submit">Alterar</button>
        </form>
    </main>
    <script>
        const imageSourceTypeElement = document.getElementById('image_source_type');
        const imageUrlContainerElement = document.getElementById('image_url_container');
        const productImageContainerElement = document.getElementById('product_image_container');

        const updateImageSourceType = () => {
            const imageSourceType = imageSourceTypeElement.value;

            if (imageSourceType === 'url') {
                imageUrlContainerElement.style.display = 'block';
                imageUrlContainerElement.querySelector('input').disabled = false;
            } else {
                imageUrlContainerElement.style.display = 'none';
                imageUrlContainerElement.querySelector('input').disabled = true;
            }

            if (imageSourceType === 'local') {
                productImageContainerElement.style.display = 'block';
                productImageContainerElement.querySelector('input').disabled = false;
            } else {
                productImageContainerElement.style.display = 'none';
                productImageContainerElement.querySelector('input').disabled = true;
            }
        }

        updateImageSourceType();
        imageSourceTypeElement.onchange = updateImageSourceType;

        const editImageOption = document.getElementById("edit_image");
        const editImageContainer = document.getElementById("edit-image-container");

        const updateEditImageOption = () => {
            editImageContainer.style.display = editImageOption.checked ? "block" : "none";
        };

        updateEditImageOption();
        editImageOption.onchange = updateEditImageOption;
    </script>
    <?php include __DIR__ . '/../includes/footer.html'; ?>
</body>

</html>
