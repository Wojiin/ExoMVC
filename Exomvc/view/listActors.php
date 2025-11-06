<?php
// Titre principal et secondaire pour la page
$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UIkit pour le style et la mise en page -->
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

                <!-- Affichage du nombre total d'acteurs -->
                <p class="uk-table uk-label-warning">Il y a <?= $requete->rowCount() ?> acteurs</p>

                <!-- Tableau listant tous les acteurs -->
                <table class="uk-table uk-table-striped">
                    <thead>
                        <tr>
                            <th>Acteurs</th>
                            <th>Date de naissance</th>
                            <th>SUPPRIMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Boucle sur tous les acteurs récupérés par le controller
                        foreach($requete->fetchAll() as $actor) { ?>
                            <tr>
                                <!-- Lien vers les détails de l'acteur -->
                                <td>
                                    <a href="index.php?action=detActor&id=<?= $actor['id_actor'] ?>"><?= $actor["first_name"] ?> <?= $actor["last_name"] ?></a></td>
                                <!-- Date de naissance de l'acteur -->
                                <td><?= $actor["birthday"] ?></td>
                                <!-- Lien pour supprimer l'acteur -->
                                <td>
                                    <a href="index.php?action=deleteActor&id=<?= $actor['id_actor'] ?>">Supprimer</a>
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
