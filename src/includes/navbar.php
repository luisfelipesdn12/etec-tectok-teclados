<style>
    #nav-text-logo {
        height: 2rem;
    }

    @media (max-width: 600px) {
        #nav-text-logo {
            height: 1.5rem;
        }
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href=".">
            <picture>
                <source srcset="/assets/tectok-only-text-white.svg" media="(max-width: 600px)">
                <img id="nav-text-logo" src="/assets/tectok-text-white.svg" alt="TecTok Teclados" title="TecTok Teclados">
            </picture>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href=".">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Termos</a>
                </li>
                <li class="nav-item" style="margin-right: 1rem;">
                    <a class="nav-link" href="#">Contato</a>
                </li>
                <?php

                try {
                    $categories = get_categories();

                    if (isset($categories) && !empty($categories)) { ?>
                        <li class="nav-item dropdown" style="margin-right: 1rem;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorias
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($categories as $category) { ?>
                                    <li>
                                        <a class="dropdown-item" href="/category.php?id=<?php echo $category['id'] ?>">
                                            <?php echo $category['name'] ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                <?php }
                } catch (Exception $e) {
                } ?>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Faça uma pesquisa..." aria-label="Faça uma pesquisa...">
                    <button class="material-icons-outlined btn btn-dark" type="submit">
                        search
                    </button>
                </form>
            </ul>
            <a href="https://github.com/luisfelipesdn12/etec-tectok-teclados" target="_blank" rel="noopener noreferrer" class="btn btn-dark" title="Código Fonte">
                <img src="https://img.icons8.com/material-outlined/250/69C9D0/github" alt="Github" style="height: 24px;">
            </a>
            <button class="material-icons-outlined btn btn-dark" title="Entrar" onclick="location.href='/login.php'">
                login
            </button>
        </div>
    </div>
</nav>