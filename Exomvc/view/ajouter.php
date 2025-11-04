<!-- Lien vers l'accueil du site -->
<a href="index.php?action=accueil">ACCUEIL</a>

<!-- Section pour ajouter un genre -->
<h2>Ajouter un genre de film</h2>

<!-- Formulaire pour ajouter un nouveau genre -->
<form action="index.php?action=ajouterGenre" method="post">
    <!-- Label et champ texte pour le nom du genre -->
    <label for="wording">Nom du genre :</label>
    <input type="text" name="wording">

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>

<!-- Section pour ajouter un film -->
<h2>Ajouter un film</h2>

<!-- Formulaire pour ajouter un nouveau film -->
<form action="index.php?action=ajouterFilm" method="post">

    <!-- Champ pour le titre du film -->
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title">

    <!-- Champ pour l'année de sortie -->
    <label for="year_of_release">Année de sortie :</label>
    <input type="number" id="year_of_release" name="year_of_release">

    <!-- Champ pour la durée en minutes -->
    <label for="duration">Durée (en minutes) :</label>
    <input type="number" id="duration" name="duration">

    <!-- Sélecteur pour choisir le réalisateur -->
    <label for="id_director">Réalisateur :</label>
    <select id="id_director" name="id_director">
        <option> Sélectionnez un réalisateur </option>
        <?php
        // Connexion à la base de données
        $pdo = \Model\Connect::seConnecter();

        // Récupération des réalisateurs
        $requeteDirectors = $pdo->query(
            "SELECT d.id_director, CONCAT(p.first_name, ' ', p.last_name) AS nom
             FROM director d
             INNER JOIN person p ON d.id_person = p.id_person
             ORDER BY p.last_name"
        );
        $directors = $requeteDirectors->fetchAll();

        // Boucle pour afficher chaque réalisateur dans la liste déroulante
        foreach ($directors as $director) {
            echo "<option value='{$director['id_director']}'>{$director['nom']}</option>";
        }
        ?>
    </select>

    <!-- Champ pour sélectionner un ou plusieurs genres -->
    <fieldset>
        <legend>Genres :</legend>
        <?php
        // Récupère tous les genres
        $requeteGenres = $pdo->query("SELECT id_genre, wording FROM genre ORDER BY wording");

        // Boucle sur chaque genre pour créer un checkbox
        while ($genre = $requeteGenres->fetch()) {
            echo "<label>
                    <input type='checkbox' name='genres[]' value='{$genre['id_genre']}'>
                    {$genre['wording']}
                  </label><br>";
        }
        ?>
    </fieldset>

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>

<!-- Section pour ajouter une personne (acteur ou réalisateur) -->
<h2>Ajouter une personne (acteur / réalisateur)</h2>

<!-- Formulaire pour ajouter une nouvelle personne -->
<form action="index.php?action=ajouterPerson" method="post">
    <!-- Champ pour le prénom -->
    <label>Prénom :</label>
    <input type="text" name="first_name">

    <!-- Champ pour le nom -->
    <label>Nom :</label>
    <input type="text" name="last_name">

    <!-- Sélecteur pour le sexe -->
    <label>Sexe :</label>
    <select name="gender">
        <option>Homme</option>
        <option>Femme</option>
        <option>Non-binaire</option>
        <option>Autre</option>
    </select>

    <!-- Champ pour la date de naissance -->
    <label>Date de naissance :</label>
    <input type="date" name="birthday">

    <!-- Checkbox pour définir le rôle de la personne -->
    <fieldset>
        <legend>Rôle :</legend>
        <label><input type="checkbox" name="isActor"> Acteur</label>
        <label><input type="checkbox" name="isDirector"> Réalisateur</label>
    </fieldset>

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" name="submit">Ajouter</button>
</form>
