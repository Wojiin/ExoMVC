
<?php
$titre = "Détails de l'acteur";
$titre_secondaire = "Détails de l'acteur";?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.24.2/dist/css/uikit.min.css" />
    <title><?= $titre ?></title>
</head>
<body>
    <nav class ="uk-navbar-container" uk-navbar uk-sticky>

</nav>
<div id="wrapper" class="uk-container uk-container-expand">
    <main>
        <a href="index.php?action=accueil">ACCUEIL</a>
        <div id="contenu">
            <h1 class="uk-heading-divider">PDO Cinema</h1>
            <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>ACTEUR</th>
            <th>GENRE</th>
            <th>DATE DE NAISSANCE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteActeur->fetchAll() as $actor) { ?>
                <tr>
                    <td><?= $actor["first_name"] ?> <?= $actor["last_name"] ?></td>
                    <td><?= $actor["gender"] ?></td>
                    <td><?= $actor["birthday"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>
<?php
// On récupère toutes les carrières une seule fois
$carrieres = $requeteCarriere->fetchAll();
$dernierIndex = array_key_last($carrieres);
?>
 
<p>A joué dans :</p>
<p>
<?php foreach ($carrieres as $index => $carriere): ?>
    <a href="index.php?action=detFilm&id=<?=$carriere['id_film']?>">
<?= $carriere["title"] ?> (<?= $carriere["year_of_release"] ?>)</a>
    dans le rôle de <strong><?= $carriere["character_first_name"] ?> <?= $carriere["character_last_name"] ?></strong>
<?= ($index === $dernierIndex) ? '.' : ', ' ?>
<?php endforeach; ?>
</p>
        </main>
    </div>
</body>
</html>

