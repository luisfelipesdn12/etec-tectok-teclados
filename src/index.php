<!DOCTYPE html>
<html lang="pt-BR">
<?php

session_start();
include  __DIR__ . '/database.php';
include __DIR__ . '/utils.php';

?>

<head>
    <?php

    include 'includes/seo.html';
    include 'includes/imports.html';

    ?>
</head>

<body class="bg-dark" style="--bs-bg-opacity: .95;">
    <?php

    include 'includes/navbar.php';
    include 'includes/header.html';
    include 'includes/products.php';
    include 'includes/footer.html';

    ?>
</body>

</html>
