<?php
$titre = "Détails du film";
$titre_secondaire = "Détails du film";?>
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
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            <th>DUREE</th>
            <th>REALISATEUR</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteFilm->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["title"] ?></td>
                    <td><?= $film["year_of_release"] ?></td>
                    <td><?= $film["duration"] ?></td>
                    <td><a href="index.php?action=detDirector&id=<?=$film['id_director']?>"><?= $film["first_name"] ?> <?= $film["last_name"] ?></a></td>                   
                </tr>
        <?php } ?>
    </tbody>
</table>
<?php
// On récupère toutes les carrières une seule fois
$castings= $requeteCasting->fetchAll();
$dernierIndex = array_key_last($castings);
?>
 
<p>Avec :</p>
    <p>
    <?php foreach($castings as $index => $casting):  ?>
        <a href="index.php?action=detActor&id=<?=$casting['id_actor']?>">
    <?= $casting["first_name"] ?> <?=$casting["last_name"]  ?></a> dans le rôle de <?= $casting["character_first_name"] ?> <?= $casting["character_last_name"] ?>
    <?= ($index === $dernierIndex) ? '.' : ', ' ?>
    <?php endforeach; ?>
    </p>
        </main>
    </div>
</body>
</html>