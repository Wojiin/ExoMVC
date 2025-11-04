<?php
// Titre principal et secondaire de la page
$titre = "Détails du réalisateur";
$titre_secondaire = "Détails du réalisateur";
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

                <!-- Tableau des informations du réalisateur -->
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
                        // Boucle sur le résultat de la requête pour afficher les informations du réalisateur
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
                // On récupère tous les films réalisés par ce réalisateur
                $films = $requeteFilmo->fetchAll();
                // On récupère l'index du dernier élément pour gérer la ponctuation
                $dernierIndex = array_key_last($films);
                ?>

                <!-- Liste des films réalisés par le réalisateur -->
                <p>A réalisé :</p>
                <p>
                    <?php foreach ($films as $index => $film): ?>
                        <!-- Lien vers le détail du film -->
                        <a href="index.php?action=detFilm&id=<?= $film['id_film'] ?>">
                            <?= $film["title"] ?> (<?= $film["year_of_release"] ?>)
                        </a>
                        <!-- Ajoute un point à la fin et une virgule sinon -->
                        <?= ($index === $dernierIndex) ? '.' : ', ' ?>
                    <?php endforeach; ?>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
