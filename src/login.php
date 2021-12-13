<!DOCTYPE html>
<html lang="pt-BR">
<?php

include __DIR__ . '/database.php';
include __DIR__ . '/utils.php';

$redirect_to = $_GET['redirect_to'] ?? '/';

?>

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

    #account-creation-sucess-toast {
        background-color: var(--blue);
        max-width: 330px;
    }
</style>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <div class="position-fixed top-0 end-0 p-3 d-flex justify-content-center" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="account-creation-sucess-toast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center">
                    Conta criada! Pode fazer seu login :)
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php if ($_GET['signup_sucess']) { ?>
        <script>
            const toast = new bootstrap.Toast(document.getElementById("account-creation-sucess-toast"));
            toast.show();
        </script>
    <?php } ?>

    <main class="form-signin text-center">
        <form class="bg-dark" method="POST" action="login_validation.php">
            <a href="/" title="Página inicial">
                <img class="mb-4" src="/assets/tectok-text-white.svg" alt="TecTok Teclados">
            </a>
            <input type="text" name="redirect_to" value="<?= $redirect_to ?>" hidden>
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
            <a href="<?= $redirect_to ? '/signup.php?redirect_to=' . $redirect_to : '/signup.php' ?>">
                Ainda não tenho uma conta
            </a>
        </form>
    </main>
</body>

</html>
