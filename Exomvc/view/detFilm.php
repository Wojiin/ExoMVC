<?php
// Titre principal et secondaire
$titre = "Détails du film";
$titre_secondaire = "Détails du film";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UIkit pour le style et tableau -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.24.2/dist/css/uikit.min.css" />
    <title><?= $titre ?></title>
</head>
<body>
    <!-- Lien retour vers l'accueil -->
    <a href="index.php?action=accueil">ACCUEIL</a>

    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>

                <!-- Tableau des informations principales du film -->
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
                        <?php foreach($requeteFilm->fetchAll() as $film) { ?>
                        <tr>
                            <td><?= $film["title"] ?></td>
                            <td><?= $film["year_of_release"] ?></td>
                            <td><?= $film["duration"] ?></td>
                            <td>
                                <a href="index.php?action=detDirector&id=<?= $film['id_director'] ?>">
                                    <?= $film["first_name"] ?> <?= $film["last_name"] ?>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Liste des acteurs et rôles -->
                <?php
                $castings = $requeteCasting->fetchAll();
                $dernierIndex = array_key_last($castings);
                ?>
                <p>Avec :</p>
                <p>
                    <?php foreach($castings as $index => $casting): ?>
                        <a href="index.php?action=detActor&id=<?= $casting['id_actor'] ?>">
                            <?= $casting["first_name"] ?> <?= $casting["last_name"] ?>
                        </a> dans le rôle de 
                        <strong><?= $casting["character_first_name"] ?> <?= $casting["character_last_name"] ?></strong>
                        <?= ($index === $dernierIndex) ? '.' : ', ' ?>
                    <?php endforeach; ?>
                </p>

                <!-- Formulaire pour ajouter un rôle -->
                <h3>Ajouter un rôle :</h3>
                <form action="index.php?action=ajouterRole&id=<?= $film['id_film'] ?>" method="post">
                    <label for="character_first_name">Prénom du rôle :</label>
                    <input type="text" id="character_first_name" name="character_first_name">

                    <label for="character_last_name">Nom du rôle :</label>
                    <input type="text" id="character_last_name" name="character_last_name">

                    <label for="id_actor">Acteur :</label>
                    <select id="id_actor" name="id_actor">
                        <option value="">Sélectionnez un acteur</option>
                        <?php
                        $actors = $requeteActors->fetchAll();
                        foreach ($actors as $actor) {
                            echo "<option value='{$actor['id_actor']}'>{$actor['nom']}</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" name="submit">Ajouter</button>
                </form>

                <!-- Formulaire pour modifier le film -->
                <h3>Modifier le film :</h3>
                <form action="index.php?action=updateFilm&id=<?= $film['id_film'] ?>" method="post">
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" placeholder="<?= $film['title'] ?>">

                    <label for="year_of_release">Année de sortie :</label>
                    <input type="number" id="year_of_release" name="year_of_release" placeholder="<?= $film['year_of_release'] ?>">

                    <label for="duration">Durée (en minutes) :</label>
                    <input type="number" id="duration" name="duration" placeholder="<?= $film['duration'] ?>">

                    <label for="id_director">Réalisateur :</label>
                    <select id="id_director" name="id_director">
                        <option value="">Sélectionnez un réalisateur</option>
                        <?php
                        $directors = $requeteDirectors->fetchAll();
                        foreach ($directors as $director) {
                            echo "<option value='{$director['id_director']}'>{$director['nom']}</option>";
                        }
                        ?>
                    </select>

                    <fieldset>
                        <legend>Genres :</legend>
                        <?php
                        $requeteGenres = $pdo->prepare(
                            "SELECT g.id_genre, g.wording, c.id_genre AS linked
                             FROM genre g
                             LEFT JOIN classified c ON g.id_genre = c.id_genre AND c.id_film = :id"
                        );
                        $requeteGenres->execute(["id" => $id]);
                        $genres = $requeteGenres->fetchAll();

                        foreach ($genres as $genre) {
                            echo "<label>
                                    <input type='checkbox' name='genres[]' value='{$genre['id_genre']}'" .
                                    ($genre['linked'] ? " checked" : "") .
                                 ">
                                    {$genre['wording']}
                                  </label><br>";
                        }
                        ?>
                    </fieldset>

                    <button type="submit" name="submit">Mettre à jour</button>
                </form>

            </div>
        </main>
    </div>
</body>
</html>
