<?php
// Titre principal et secondaire de la page
$titre = "Détails de l'acteur";
$titre_secondaire = "Détails de l'acteur";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS UIkit pour le style des tableaux et composants -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.24.2/dist/css/uikit.min.css" />
    <title><?= $titre ?></title>
</head>
<body>
    <!-- Barre de navigation (vide ici mais peut être remplie dynamiquement) -->
    <nav class="uk-navbar-container" uk-navbar uk-sticky></nav>

    <!-- Conteneur principal -->
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <!-- Lien retour vers l'accueil -->
            <a href="index.php?action=accueil">ACCUEIL</a>

            <div id="contenu">
                <!-- Titre principal et secondaire de la page -->
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>

                <!-- Tableau des informations de l'acteur -->
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
                        // Boucle sur le résultat de la requête pour afficher les informations de l'acteur
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
                // On récupère toutes les carrières une seule fois pour éviter de faire plusieurs fetchAll()
                $carrieres = $requeteCarriere->fetchAll();
                // On récupère l'index du dernier élément pour gérer la ponctuation
                $dernierIndex = array_key_last($carrieres);
                ?>

                <!-- Liste des films dans lesquels l'acteur a joué -->
                <p>A joué dans :</p>
                <p>
                    <?php foreach ($carrieres as $index => $carriere): ?>
                        <!-- Lien vers le détail du film -->
                        <a href="index.php?action=detFilm&id=<?= $carriere['id_film'] ?>">
                            <?= $carriere["title"] ?> (<?= $carriere["year_of_release"] ?>)
                        </a>
                        <!-- Affiche le rôle joué -->
                        dans le rôle de <strong><?= $carriere["character_first_name"] ?> <?= $carriere["character_last_name"] ?></strong>
                        <!-- Ajoute un point à la fin et une virgule sinon -->
                        <?= ($index === $dernierIndex) ? '.' : ', ' ?>
                    <?php endforeach; ?>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
