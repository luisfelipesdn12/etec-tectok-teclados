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
</head>

<style>
    .admin-option {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
    }

    .admin-option img {
        width: 2.5rem;
        height: 2.5rem;
        margin-right: 0.5rem;
    }

    .admin-option p {
        margin: 0;
        padding: 0;
        font-weight: 500;
        font-size: 1.25rem;
    }
</style>

<script>
    function searchRequest() {
        document.getElementById("search-input").focus();
        const toast = new bootstrap.Toast(document.getElementById("search-to-perform-action-toast"));
        toast.show();
    }
</script>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <div class="position-fixed bottom-0 end-0 p-3 d-flex justify-content-center" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="search-to-perform-action-toast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" style="width: max-content;">
            <div class="d-flex text-center">
                <div class="toast-body text-center">
                    Busque um produto e vá em detalhes para completar esta ação.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../includes/navbar.php'; ?>
    <?php include __DIR__ . '/../includes/header.html'; ?>
    <section class="p-5">
        <h1 class="mb-4">
            Área Administrativa
        </h1>
        <div class="row" style="row-gap: 20px;">
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2" onclick="location.href='/admin/add.php'">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/add" alt="Adicionar">
                <p>Incluir Produto</p>
            </button>
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2" onclick="searchRequest()">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/edit" alt="Editar">
                <p>Alterar Produto</p>
            </button>
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2" onclick="searchRequest()">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/delete" alt="Excluir">
                <p>Excluir Produto</p>
            </button>
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/shopping-bag" alt="Sacola de Compras">
                <p>Vendas</p>
            </button>
        </div>
    </section>
    <?php include __DIR__ . '/../includes/footer.html'; ?>
</body>

</html>
