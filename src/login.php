<!DOCTYPE html>
<html lang="pt-BR">
<?php include __DIR__ . '/database.php'; ?>
<?php include __DIR__ . '/utils.php'; ?>

<head>
    <?php include 'includes/seo.html' ?>
    <?php include 'includes/imports.html' ?>
</head>

<style>
    main {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    form {
        padding: 2rem;
        border-radius: 0.5rem;
        max-width: 330px;
        margin: auto;
    }

    img {
        max-width: 100%;
    }

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
</style>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <main class="form-signin text-center">
        <form class="bg-dark">
            <img class="mb-4" src="/assets/tectok-text-white.svg" alt="TecTok Teclados">
            <div class="form-floating my-2">
                <input required type="email" class="form-control" id="floatingInput" placeholder="nome@tectok.com">
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating my-2">
                <input required type="password" class="form-control" id="floatingPassword" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
            </div>
            <button class="my-3 w-100 btn btn-lg fw-bolder" type="submit">Entrar</button>
            <a href="#">Ainda não tenho uma conta</a>
        </form>
    </main>
</body>

</html>