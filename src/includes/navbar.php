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

<?php

$is_logged_in = !empty($_SESSION['user']);

?>

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
                    <a class="nav-link" href="news.php">Novidades</a>
                </li>
                <?php

                try {
                    $categories = $db->get_categories();

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
                <form class="d-flex" action="search.php">
                    <input class="form-control me-2" name="q" type="search" placeholder="Faça uma pesquisa..." aria-label="Faça uma pesquisa..." value="<?php echo $_GET['q']; ?>" required>
                    <button class="material-icons-outlined btn btn-dark" type="submit">
                        search
                    </button>
                </form>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
                <?php if ($is_logged_in) {?>
                    <a
                        href="<?php echo is_admin() ? '/admin' : '#' ?>"
                        class="d-flex justify-content-between align-items-center m-0 badge text-dark"
                        style="font-size: 0.9rem; height: 100%; background-color: var(--blue); text-decoration: none;"
                    >
                        <span class="material-icons-outlined text-dark" style="margin-right: 0.5rem; font-size: 1.25rem;">
                            account_circle
                        </span>
                        <?php echo $_SESSION['user']['name']; ?>
                        <?php echo is_admin() ? ' (Admin)' : '' ?>
                    </a>
                <?php } ?>
                <a href="https://github.com/luisfelipesdn12/etec-tectok-teclados" target="_blank" rel="noopener noreferrer" class="btn btn-dark" title="Código Fonte">
                    <img src="https://img.icons8.com/material-outlined/250/69C9D0/github" alt="Github" style="height: 24px;">
                </a>
                <button class="material-icons-outlined btn btn-dark" title="<?php echo $is_logged_in ? "Sair da conta" : "Entrar na conta"; ?>" onclick="location.href='<?php echo $is_logged_in ? "logout.php" : "login.php"; ?>'">
                    <?php echo $is_logged_in ? "logout" : "login"; ?>
                </button>
            </div>
        </div>
    </div>
</nav>
