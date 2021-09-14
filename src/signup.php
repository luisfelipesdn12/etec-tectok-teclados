<!DOCTYPE html>
<html lang="pt-BR">
<?php include __DIR__ . '/database.php'; ?>
<?php include __DIR__ . '/utils.php'; ?>

<head>
    <?php include 'includes/seo.html' ?>
    <?php include 'includes/imports.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
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

<script>
    $(document).ready(() => {
        $("#user_cep").mask("00000-000");
    });
</script>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <main class="form-signin text-center">
        <form class="bg-dark" method="POST" action="">
            <a href="/" title="Página inicial">
                <img class="mb-4" src="/assets/tectok-text-white.svg" alt="TecTok Teclados">
            </a>
            <div class="form-floating my-2">
                <input name="user_name" required maxlength="200" type="text" class="form-control" id="user_name" placeholder="Nome">
                <label for="user_name">Nome</label>
            </div>
            <div class="form-floating my-2">
                <input name="user_email" required maxlength="200" type="email" class="form-control" id="user_email" placeholder="nome@tectok.com">
                <label for="user_email">E-mail</label>
            </div>
            <div class="form-floating my-2">
                <input name="user_password" required maxlength="200" type="password" class="form-control" id="user_password" placeholder="Senha">
                <label for="user_password">Senha</label>
            </div>
            <div class="form-floating my-2">
                <input name="user_cep" required minlength=9 type="text" class="form-control" id="user_cep" placeholder="00000-000">
                <label for="user_cep">CEP</label>
            </div>
            <p id="cep-error-notice" class="error-message m-0" style="display: none;">
                Não foi possível encontrar o endereço a partir do CEP informado
            </p>
            <div class="form-floating my-2">
                <input disabled type="text" class="form-control text-muted" id="user_address" placeholder="Endereço">
                <label for="user_address">Endereço</label>
            </div>
            <div class="form-floating my-2">
                <input name="user_address_number" required type="number" class="form-control" id="user_address_number" placeholder="100">
                <label for="user_address_number">Número do Endereço</label>
            </div>
            <button id="submit-signup-button" disabled class="my-3 w-100 btn btn-lg fw-bolder" type="submit">Cadastrar</button>
            <a href="/login.php">Já tenho uma conta</a>
        </form>
    </main>
</body>

<script>
    const cepInput = document.getElementById("user_cep");
    const addressInput = document.getElementById("user_address");
    const submitButton = document.getElementById("submit-signup-button");

    cepInput.onchange = () => {
        const cep = cepInput.value && cepInput.value.replace("-", "");

        if (cep && cep.length == 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json`)
                .then(res => res.json())
                .then(data => {
                    if (data["erro"] == true) {
                        throw new Error("API returned error");
                    }

                    submitButton.disabled = false;
                    addressInput.value = `${data["logradouro"]} - ${data["localidade"]}`;
                    document.getElementById("cep-error-notice").style.display = "none";
                })
                .catch(err => {
                    console.error(err);
                    addressInput.value = "";
                    submitButton.disabled = true;
                    document.getElementById("cep-error-notice").style.display = "block";
                });
        }
    };
</script>

</html>
