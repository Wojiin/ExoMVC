
<?php
$titre = "Détails du réalisateur";
$titre_secondaire = "Détails du réalisateur";?>
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
        <div id="contenu">
            <h1 class="uk-heading-divider">PDO Cinema</h1>
            <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>REALISATEUR</th>
            <th>GENRE</th>
            <th>DATE DE NAISSANCE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteDirector->fetchAll() as $director) { ?>
                <tr>
                    <td><?= $director["first_name"] ?> <?= $director["last_name"] ?></td>
                    <td><?= $director["gender"] ?></td>
                    <td><?= $director["birthday"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>
<?php
// On récupère toutes les carrières une seule fois
$films = $requeteFilmo->fetchAll();
$dernierIndex = array_key_last($films);
?>
 
<p>A réalisé :</p>
<p>
<?php foreach ($films as $index => $film): ?>
    <a href="index.php?action=detFilm&id=<?=$film['id_film']?>">
<?= $film["title"] ?> (<?= $film["year_of_release"] ?>)</a>
<?= ($index === $dernierIndex) ? '.' : ', ' ?>
<?php endforeach; ?>
</p>
        </main>
    </div>
</body>
</html>