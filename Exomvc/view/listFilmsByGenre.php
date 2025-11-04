<?php
// Titre principal et secondaire
$titre = "Films par genre";
$titre_secondaire = "Films par genre";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UIkit pour le style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.24.2/dist/css/uikit.min.css" />
    <title><?= $titre ?></title>
</head>
<body>
    <!-- Lien vers l'accueil -->
    <a href="index.php?action=accueil">ACCUEIL</a>

    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <!-- Titres de la page -->
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>

                <!-- Affichage du nombre de films dans ce genre -->
                <p class="uk-table uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

                <!-- Tableau des films du genre -->
                <table class="uk-table uk-table-striped">
                    <thead>
                        <tr>
                            <th>TITRE</th>
                            <th>ANNEE SORTIE</th>
                            <th>SUPPRIMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Boucle sur tous les films récupérés par le controller
                        foreach($requete->fetchAll() as $film) { ?>
                            <tr>
                                <!-- Lien vers les détails du film -->
                                <td>
                                    <a href="index.php?action=detFilm&id=<?= $film['id_film'] ?>">
                                        <?= $film["title"] ?>
                                    </a>
                                </td>
                                <td><?= $film["year_of_release"] ?></td>
                                <td>
                                    <!-- Lien pour supprimer le film -->
                                    <a href="index.php?action=deleteFilm&id=<?= $film['id_film'] ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </main>
    </div>
</body>
</html>
