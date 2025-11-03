<a href="index.php?action=accueil">ACCUEIL</a>
<h2>Ajouter un genre de film</h2>

<form action="index.php?action=ajouterGenre" method="post">
    <label for="wording">Nom du genre :</label>
    <input type="text" name="wording">
    <button type="submit" name="submit">Ajouter</button>
</form>

<h2>Ajouter un film</h2>

<form action="index.php?action=ajouterFilm" method="post">

    <label for="title">Titre :</label>
    <input type="text" id="title" name="title">

    <label for="year_of_release">Année de sortie :</label>
    <input type="number" id="year_of_release" name="year_of_release">

    <label for="duration">Durée (en minutes) :</label>
    <input type="number" id="duration" name="duration">

    <label for="id_director">Réalisateur :</label>
    <select id="id_director" name="id_director">
        <option> Sélectionnez un réalisateur </option>
        <?php
        $pdo = \Model\Connect::seConnecter();
        $requeteDirectors = $pdo->query("
            SELECT d.id_director, CONCAT(p.first_name, ' ', p.last_name) AS nom
            FROM director d
            INNER JOIN person p ON d.id_person = p.id_person
            ORDER BY p.last_name
        ");
        $directors = $requeteDirectors->fetchAll();

        foreach ($directors as $director) {
            echo "<option value='{$director['id_director']}'>{$director['nom']}</option>";
        }
        ?>
    </select>

    <fieldset>
        <legend>Genres :</legend>
        <?php
        $requeteGenres = $pdo->query("SELECT id_genre, wording FROM genre ORDER BY wording");
        while ($genre = $requeteGenres->fetch()) {
            echo "<label>
                    <input type='checkbox' name='genres[]' value='{$genre['id_genre']}'>
                    {$genre['wording']}
                  </label><br>";
        }
        ?>
    </fieldset>

    <button type="submit" name="submit">Ajouter</button>
</form>

<h2>Ajouter une personne (acteur / réalisateur)</h2>

<form action="index.php?action=ajouterPerson" method="post">
    <label>Prénom :</label>
    <input type="text" name="first_name">

    <label>Nom :</label>
    <input type="text" name="last_name">

    <label>Sexe :</label>
    <select name="gender">
        <option>Homme</option>
        <option>Femme</option>
        <option>Non-binaire</option>
        <option>Autre</option>
    </select>

    <label>Date de naissance :</label>
    <input type="date" name="birthday">

    <fieldset>
        <legend>Rôle :</legend>
        <label><input type="checkbox" name="isActor"> Acteur</label>
        <label><input type="checkbox" name="isDirector"> Réalisateur</label>
    </fieldset>

    <button type="submit" name="submit">Ajouter</button>
</form>
