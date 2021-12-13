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
</style>

<script>
    $(document).ready(() => {
        $("#user_cep").mask("00000-000");
    });
</script>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <main class="form-signin text-center">
        <form class="bg-dark" method="POST" action="signup_validation.php">
            <a href="/" title="Página inicial">
                <img class="mb-4" src="/assets/tectok-text-white.svg" alt="TecTok Teclados">
            </a>
            <input type="text" name="redirect_to" value="<?= $redirect_to ?>" hidden>
            <div class="form-floating my-2">
                <input name="user_name" required maxlength="200" type="text" class="form-control" id="user_name" placeholder="Nome">
                <label for="user_name">Nome</label>
            </div>
            <div class="form-floating my-2">
                <input name="user_email" required maxlength="200" type="email" class="form-control" id="user_email" placeholder="nome@tectok.com">
                <label for="user_email">E-mail</label>
            </div>
            <?php if ($_GET['existent_email_error']) { ?>
                <p class="error-message m-0">
                    E-mail já cadastrado
                </p>
            <?php } ?>
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
    class CEPCompleter {
        constructor(cepIputId, addressInputId, submitButtonId, errorNoticeId) {
            this.cepInput = document.getElementById(cepIputId);
            this.addressInput = document.getElementById(addressInputId);
            this.submitButton = document.getElementById(submitButtonId);
            this.errorNotice = document.getElementById(errorNoticeId);

            this.cepInput.onchange = () => {
                const cep = this.cepInput.value && this.cepInput.value.replace("-", "");

                if (cep && cep.length == 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json`)
                        .then(res => res.json())
                        .then(data => {
                            if (data["erro"] == true) {
                                throw new Error("API returned error");
                            }

                            this.submitButton.disabled = false;
                            this.addressInput.value = `${data["logradouro"]} - ${data["localidade"]}`;
                            this.errorNotice.style.display = "none";
                        })
                        .catch(err => {
                            console.error(err);
                            this.addressInput.value = "";
                            this.submitButton.disabled = true;
                            this.errorNotice.style.display = "block";
                        });
                }
            };
        }
    }

    new CEPCompleter("user_cep", "user_address", "submit-signup-button", "cep-error-notice");
</script>

</html>
