<?php
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.24.2/dist/css/uikit.min.css" />

    <title><?= $titre ?></title>
</head>
<body>
    <a href="index.php?action=accueil">ACCUEIL</a>
    <nav class ="uk-navbar-container" uk-navbar uk-sticky>

    </nav>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
    <p class="uk-table uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>

    <table class="uk-table uk-table-striped">
        <thead>
            <tr>
                <th>Acteurs</th>
                <th>Date de naissance</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($requete->fetchAll() as $actor) { ?>
                    <tr>
                        <td><a href="index.php?action=detActor&id=<?=$actor['id_actor']?>"><?= $actor["first_name"] ?> <?= $actor["last_name"] ?></a></td>
                        <td><?= $actor["birthday"] ?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
        </main>
    </div>
</body>
</html>
<?php