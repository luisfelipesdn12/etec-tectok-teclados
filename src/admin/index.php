<!DOCTYPE html>
<html lang="pt-BR">

<?php
    session_start();
    include __DIR__ . '/../database.php';
    include __DIR__ . '/../utils.php';

    if (empty($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
        header("Location: /" );
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

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php include __DIR__ . '/../includes/navbar.php'; ?>
    <?php include __DIR__ . '/../includes/header.html'; ?>
    <section class="p-5">
        <h1 class="mb-4">
            Área Administrativa
        </h1>
        <div class="row" style="row-gap: 20px;">
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/add" alt="Adicionar">
                <p>Incluir Produto</p>
            </button>
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/edit" alt="Editar">
                <p>Alterar Produto</p>
            </button>
            <button class="admin-option btn col-sm-5 bg-dark rounded mx-2">
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
