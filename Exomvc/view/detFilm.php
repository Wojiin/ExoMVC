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
            <a href="index.php?action=accueil">ACCUEIL</a>
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
    <?= $casting["first_name"] ?> <?=$casting["last_name"]  ?></a> dans le rôle de <strong><?= $casting["character_first_name"] ?> <?= $casting["character_last_name"] ?></strong>
    <?= ($index === $dernierIndex) ? '.' : ', ' ?>
    <?php endforeach; ?>
    </p>

<h3>Ajouter un rôle :</h3>

<form action="index.php?action=detFilm&id=<?= $film['id_film']?>" method="post">

    <label for="character_first_name">Prénom du rôle :</label>
    <input type="text" id="character_first_name" name="character_first_name">

    <label for="character_last_name">Nom du rôle :</label>
    <input type="text" id="character_last_name" name="character_last_name">

    <label for="id_actor">Acteur :</label>
    <select id="id_actor" name="id_actor">
        <option> Sélectionnez un acteur </option>
        <?php
        $pdo = \Model\Connect::seConnecter();
         $requeteActors = $pdo->prepare(
        "SELECT DISTINCT CONCAT(p.first_name, ' ', p.last_name) AS nom
        FROM person p
        INNER JOIN actor a ON a.id_person = p.id_person
        INNER JOIN play pl ON a.id_actor = pl.id_actor
        INNER JOIN film_role fr ON fr.id_role = pl.id_role
        WHERE NOT pl.id_film = :id"
         );
        $requeteActors->execute(["id" => $id]
        ); 
        $actors = $requeteActors->fetchAll();

        foreach ($actors as $actor) {
            echo "<option value='{$actor['id_actor']}'>{$actor['nom']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="submit">Ajouter</button>
</form>
        </main>
    </div>
</body>
</html>