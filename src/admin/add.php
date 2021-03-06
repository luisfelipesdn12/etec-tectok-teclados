<!DOCTYPE html>
<html lang="pt-BR">

<?php
session_start();
include __DIR__ . '/../database.php';
include __DIR__ . '/../utils.php';

if (!is_admin()) {
    header("Location: /");
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
    }

    .form-switch .form-check-input:checked {
        background-color: var(--pink);
    }

    .form-switch .form-check-input:focus {
        border-color: rgba(0, 0, 0, 0.25);
        outline: 0;
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba(0,0,0,0.25)'/></svg>");
    }

    #db-error-toast {
        background-color: var(--pink);
        max-width: 330px;
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
                    Erro ao inserir produto ao banco de dados.
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
        <h1 class="mb-4">
            Adicionar Produto
        </h1>
        <form method="POST" action="add_validation.php" enctype="multipart/form-data">
            <h2 class="my-4">
                Informa????es
            </h2>
            <div class="form-floating my-2">
                <input name="name" required maxlength="200" type="text" class="form-control" id="name" placeholder="Nome">
                <label for="name">Nome</label>
            </div>
            <div class="form-floating my-2">
                <input name="price" required type="text" class="form-control" id="price" placeholder="Pre??o">
                <label for="price">Pre??o</label>
            </div>
            <div class="form-floating my-2">
                <textarea name="description" required maxlength="2000" type="" class="form-control" id="description" placeholder="Descri????o"></textarea>
                <label for="description">Descri????o</label>
            </div>
            <div class="form-floating my-2">
                <input name="quantity_available" required type="number" class="form-control" id="quantity_available" placeholder="Quantidade dispon??vel">
                <label for="quantity_available">Quantidade dispon??vel</label>
            </div>
            <div class="form-floating my-2">
                <select name="category_id" id="category_id" class="form-select" placeholder="Categoria" required>
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
                <input class="form-check-input" type="checkbox" role="switch" id="is_new" name="is_new">
                <label class="form-check-label text-white" for="is_new">Novidade</label>
            </div>
            <h2 class="my-4">
                Imagem
            </h2>
            <?php if ($_GET['error_image_process']) { ?>
                <p class="error-message m-0">
                    Erro ao processar imagem enviada. Tente novamente.
                </p>
            <?php } ?>
            <div class="form-floating my-2">
                <select name="image_source_type" id="image_source_type" class="form-select" placeholder="Fonte da imagem" value="local" required>
                    <option value="local">Upload de arquivo local</option>
                    <option value="url">URL da internet</option>
                </select>
                <label for="image_source_type">Fonte da imagem</label>
            </div>
            <div class="form-floating my-2" id="image_url_container">
                <input name="image_url" required maxlength="500" type="url" class="form-control" id="image_url" placeholder="URL da imagem">
                <label for="image_url">URL da imagem</label>
            </div>
            <div class="my-2" id="product_image_container">
                <input name="product_image" required type="file" accept="image/*" class="form-control" id="product_image">
            </div>
            <button class="my-3 w-100 btn btn-lg fw-bolder" type="submit">Cadastrar</button>
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
    </script>
    <?php include __DIR__ . '/../includes/footer.html'; ?>
</body>

</html>
