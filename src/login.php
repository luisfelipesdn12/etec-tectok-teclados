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

    .error-message {
        color: var(--pink);
    }
</style>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <main class="form-signin text-center">
        <form class="bg-dark" method="POST" action="login_validation.php">
            <a href="/" title="Página inicial">
                <img class="mb-4" src="/assets/tectok-text-white.svg" alt="TecTok Teclados">
            </a>
            <div class="form-floating my-2">
                <input name="user_email" required type="email" class="form-control" id="user_email" placeholder="nome@tectok.com">
                <label for="user_email">E-mail</label>
            </div>
            <?php if ($_GET['invalid_email_error']) { ?>
                <p class="error-message m-0">
                    E-mail não cadastrado
                </p>
            <?php } ?>
            <div class="form-floating my-2">
                <input name="user_password" required type="password" class="form-control" id="user_password" placeholder="Senha">
                <label for="user_password">Senha</label>
            </div>
            <?php if ($_GET['wrong_password_error']) { ?>
                <p class="error-message m-0">
                    Senha incorreta
                </p>
            <?php } ?>
            <button class="my-3 w-100 btn btn-lg fw-bolder" type="submit">Entrar</button>
            <a href="/signup.php">Ainda não tenho uma conta</a>
        </form>
    </main>
</body>

</html>
