<?php
$titre = "Films par genre";
$titre_secondaire = "Films par genre";
?>

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
            

            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>TITRE</th>
                        <th>ANNEE SORTIE</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                        ?>
                    <p class="uk-table uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>
                    <?php                        
                        foreach($requete->fetchAll() as $film) { ?>                       
                            <tr>
                                <td><a href="index.php?action=detFilm&id=<?=$film['id_film']?>"><?= $film["title"] ?></a></td>
                                <td><?= $film["year_of_release"] ?></td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
<?php
?>





