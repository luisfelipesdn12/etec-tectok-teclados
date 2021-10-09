<!DOCTYPE html>
<html lang="pt-BR">

<?php
session_start();
include __DIR__ . '/../database.php';
include __DIR__ . '/../utils.php';

if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
    header("Location: /");
}
?>

<head>
    <?php include __DIR__ . '/../includes/seo.html' ?>
    <?php include __DIR__ . '/../includes/imports.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
</head>

<style>
    a {
        color: var(--pink) !important;
        text-decoration: none !important;
    }

    a:hover {
        text-decoration: underline !important;
    }

    button.btn {
        background: var(--pink);
        color: var(--white);
    }

    button.btn:hover {
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
    <section class="p-5">
        <h1 class="mb-4">
            Adicionar Produto
        </h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-floating my-2">
                <input name="name" required maxlength="200" type="text" class="form-control" id="name" placeholder="Nome">
                <label for="name">Nome</label>
            </div>
            <div class="form-floating my-2">
                <input name="price" required type="text" class="form-control" id="price" placeholder="Preço">
                <label for="price">Preço</label>
            </div>
            <div class="form-floating my-2">
                <input name="description" required maxlength="2000" type="text" class="form-control" id="description" placeholder="Descrição">
                <label for="description">Descrição</label>
            </div>
            <div class="form-floating my-2">
                <input name="quantity_available" required type="number" class="form-control" id="quantity_available" placeholder="Quantidade disponível">
                <label for="quantity_available">Quantidade disponível</label>
            </div>
            <div class="form-floating my-2">
                <input name="image_url" required maxlength="500" type="text" class="form-control" id="image_url" placeholder="URL da imagem">
                <label for="image_url">URL da imagem</label>
            </div>
            <div class="form-floating my-2">
                <select name="category_id" id="category_id" class="form-select" placeholder="Categoria" required>
                    <?php
                    $categories = $db->get_categories("id, name");

                    foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </option>
                    <?php } ?>
                </select>
                <label for="category_id">Categoria</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="is_new" name="is_new">
                <label class="form-check-label text-white text-bold" for="is_new">Novidade</label>
            </div>
            <button id="submit-signup-button" class="my-3 w-100 btn btn-lg fw-bolder" type="submit">Cadastrar</button>
        </form>
    </section>
    <?php include __DIR__ . '/../includes/footer.html'; ?>
</body>

</html>
