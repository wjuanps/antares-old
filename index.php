<!DOCTYPE html>

<?php require_once 'src/com/wjuan/antares/util/Config.ini.php'; ?>

<html lang="pt-br" ng-app="antares">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Antares - Sentiment Analysis</title>

        <link rel="icon" href="favicon.png" type="image/x-icon" />

        <link rel="stylesheet" href=<?= __URL_BASE__ .  'web/lib/bootstrap/bootstrap.min.css' ?> />
        <link rel="stylesheet" href=<?= __URL_BASE__ .  'web/lib/ionicons/css/ionicons.css' ?> />
        <link rel="stylesheet" href=<?= __URL_BASE__ .  'web/css/custom-style.css' ?> />
    </head>

    <body>
        <?php require_once 'web/view/includes/header.php'; ?>

        <div style="height: 15rem;" class="bg-info bg-antares"></div>

        <div class="jumbotron container-fluid conteudo" ng-controller="antaresCtrl">
            <section><?php require_once 'src/com/wjuan/antares/app/redirect.php'; ?></section>
        </div>

        <?php require_once 'web/view/includes/footer.php'; ?>
        <?php require_once 'web/view/includes/scripts.html'; ?>
    </body>
</html>