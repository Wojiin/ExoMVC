<?php
// Titre principal et secondaire
$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
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

                <!-- Nombre total de réalisateurs -->
                <p class="uk-table uk-label-warning">Il y a <?= $requete->rowCount() ?> réalisateurs</p>

                <!-- Tableau listant tous les réalisateurs -->
                <table class="uk-table uk-table-striped">
                    <thead>
                        <tr>
                            <th>Réalisateurs</th>
                            <th>Date de naissance</th>
                            <th>SUPPRIMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Boucle sur tous les réalisateurs récupérés par le controller
                        foreach($requete->fetchAll() as $director) { ?>
                            <tr>
                                <!-- Lien vers les détails du réalisateur -->
                                <td>
                                    <a href="index.php?action=detDirector&id=<?= $director['id_director'] ?>">
                                        <?= $director["first_name"] ?> <?= $director["last_name"] ?>
                                    </a>
                                </td>
                                <td><?= $director["birthday"] ?></td>
                                <td>
                                    <!-- Lien pour supprimer le réalisateur -->
                                    <a href="index.php?action=deleteDirector&id=<?= $director['id_director'] ?>">SUPPRIMER</a>
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
