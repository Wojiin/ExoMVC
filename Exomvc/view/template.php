<?php
 //Mise en mémoire tampon (buffer)
 ob_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <nav class ="uk-navbar-container" uk-navbar uk-sticky>

</nav>
<div id="wrapper" class="uk-container uk-container-expand">
    <main>
        <div id="contenu">
            <h1 class="uk-heading-divider">PDO Cinema</h1>
            <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
        </div>
    </main>
</div>
</body>
</html>
<?php//Récupère et affiche le nombre d'entrées "film" dans la db
?>

<p class="uk-table uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            //Récupère et affiche dans le tableau, par le biais d'une requête, les infos " titre " et " annee_sortie " des films dans la db  
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["title"] ?></td>
                    <td><?= $film["year_of_release"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
//Fin de la mise en mémoire tampon + récupération du contenu tamponné dans la variable $contenu
$contenu = ob_get_clean();
