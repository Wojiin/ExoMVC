<?php

// Catégorise virtuellement la classe

namespace Controller;

// Récupère la PDO (PHP Data Objects)
use Model\Connect;

// Définit la classe CinemaController
class CinemaController
{
    /*
     * Liste tous les films
     */
    public function listFilms()
    {
        // Connexion à la base de données
        $pdo = Connect::seConnecter();

        // Récupère les films avec leur titre, année et identifiant
        $requete = $pdo->query(
            "SELECT title, year_of_release, id_film
             FROM film"
        );

        // Charge la vue pour afficher la liste des films
        require "view/listFilms.php";
    }

    /*
     * Supprime un film
     */
    public function deleteFilm($id)
    {
        $pdo = Connect::seConnecter();

        // Prépare la requête pour supprimer un film par son id
        $requete = $pdo->prepare(
            "DELETE FROM film f
             WHERE f.id_film = :id"
        );
        $requete->execute(["id" => $id]);

        // Redirige vers la liste des films après suppression
        header("Location:index.php?action=listFilms");

        // Charge la vue associée
        require "view/listFilms.php";
    }

    /*
     * Liste les films d’un genre donné
     */
    public function listFilmsByGenre($id)
    {
        $pdo = Connect::seConnecter();

        // Prépare la requête pour récupérer les films d’un genre
        $requete = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.id_film, g.wording
             FROM genre g
             INNER JOIN classified cl ON cl.id_genre = g.id_genre
             INNER JOIN film f ON f.id_film = cl.id_film
             WHERE g.id_genre = :id"
        );
        $requete->execute(["id" => $id]);

        // Charge la vue pour afficher les films filtrés par genre
        require "view/listFilmsByGenre.php";
    }

    /*
     * Supprime un genre
     */
    public function deleteGenre($id)
    {
        $pdo = Connect::seConnecter();

        // Prépare la requête pour supprimer un genre
        $requete = $pdo->prepare(
            "DELETE FROM genre g
             WHERE g.id_genre = :id"
        );
        $requete->execute(["id" => $id]);

        // Redirige vers l’accueil après suppression
        header("Location:index.php?action=accueil");

        // Charge la vue des genres
        require "view/listGenres.php";
    }

    /*
     * Détails d’un film
     */
    public function detFilm($id)
    {
        $pdo = Connect::seConnecter();

        // Récupère les informations du film et de son réalisateur
        $requeteFilm = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.duration, f.id_film, f.id_director, p.first_name, p.last_name
             FROM film f
             INNER JOIN director d ON d.id_director = f.id_director
             INNER JOIN person p ON p.id_person = d.id_person
             WHERE f.id_film = :id"
        );
        $requeteFilm->execute(["id" => $id]);

        // Récupère le casting du film (acteurs et leurs rôles)
        $requeteCasting = $pdo->prepare(
            "SELECT p.first_name, p.last_name, fr.character_first_name, fr.character_last_name, a.id_actor
             FROM play pl
             INNER JOIN film f ON f.id_film = pl.id_film
             INNER JOIN actor a ON a.id_actor = pl.id_actor
             INNER JOIN person p ON p.id_person = a.id_person
             INNER JOIN film_role fr ON fr.id_role = pl.id_role
             WHERE pl.id_film = :id"
        );
        $requeteCasting->execute(["id" => $id]);

        // Récupère la liste des acteurs non encore liés au film
        $requeteActors = $pdo->prepare(
            "SELECT DISTINCT CONCAT(p.first_name, ' ', p.last_name) AS nom, a.id_actor
             FROM person p
             INNER JOIN actor a ON a.id_person = p.id_person
             LEFT JOIN play pl ON a.id_actor = pl.id_actor AND pl.id_film = :id
             WHERE pl.id_film IS NULL"
        );
        $requeteActors->execute(["id" => $id]);

        // Récupère la liste des réalisateurs non encore liés au film
        $requeteDirectors = $pdo->prepare(
            "SELECT DISTINCT CONCAT(p.first_name, ' ', p.last_name) AS nom, d.id_director
             FROM person p
             INNER JOIN director d ON d.id_person = p.id_person
             LEFT JOIN film f ON d.id_director = f.id_director AND f.id_film = :id
             WHERE f.id_film IS NULL"
        );
        $requeteDirectors->execute(["id" => $id]);

        // Charge la vue des détails du film
        require "view/detFilm.php";
    }

    /*
     * Ajouter un rôle pour un film
     */
    public function ajouterRole($idFilm)
    {
        $pdo = Connect::seConnecter();

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            // Récupère et filtre les données du rôle
            $character_first_name = filter_input(INPUT_POST, "character_first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $character_last_name  = filter_input(INPUT_POST, "character_last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id_actor             = filter_input(INPUT_POST, "id_actor", FILTER_SANITIZE_NUMBER_INT);

            // Si tous les champs sont remplis
            if ($character_first_name && $character_last_name && $id_actor) {
                // Insère le rôle dans film_role
                $requeteRole = $pdo->prepare(
                    "INSERT INTO film_role (character_first_name, character_last_name)
                     VALUES (:character_first_name, :character_last_name)"
                );
                $requeteRole->execute([
                    "character_first_name" => $character_first_name,
                    "character_last_name"  => $character_last_name
                ]);

                // Récupère l'identifiant du rôle inséré
                $id_role = $pdo->lastInsertId();

                // Lier le rôle à l’acteur et au film dans play
                $requetePlay = $pdo->prepare(
                    "INSERT INTO play (id_film, id_actor, id_role)
                     VALUES (:id_film, :id_actor, :id_role)"
                );
                $requetePlay->execute([
                    "id_film"  => $idFilm,
                    "id_actor" => $id_actor,
                    "id_role"  => $id_role
                ]);
            }
        }

        // Redirection vers les détails du film
        header("Location: index.php?action=detFilm&id=$idFilm");
    }

    /*
     * Modifier un film
     */
    public function updateFilm($id)
    {
        $pdo = Connect::seConnecter();

        // Récupère les anciennes données du film
        $requete = $pdo->prepare(
            "SELECT * 
             FROM film 
             WHERE id_film = :id_film"
        );
        $requete->execute(["id_film" => $id]);
        $ancienneDonnees = $requete->fetch();

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            // Récupère et filtre les nouvelles données
            $title           = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $year_of_release = filter_input(INPUT_POST, "year_of_release", FILTER_SANITIZE_NUMBER_INT);
            $duration        = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_NUMBER_INT);
            $id_director     = filter_input(INPUT_POST, "id_director", FILTER_SANITIZE_NUMBER_INT);

            // Conserve l'ancienne valeur si le champ est vide
            if (!$title) {
                $title = $ancienneDonnees['title'];
            }
            if (!$year_of_release) {
                $year_of_release = $ancienneDonnees['year_of_release'];
            }
            if (!$duration) {
                $duration = $ancienneDonnees['duration'];
            }
            if (!$id_director) {
                $id_director = $ancienneDonnees['id_director'];
            }

            // Met à jour le film
            $requete = $pdo->prepare(
                "UPDATE film
                 SET title = :title,
                     year_of_release = :year_of_release,
                     duration = :duration,
                     id_director = :id_director
                 WHERE id_film = :id_film"
            );
            $requete->execute([
                "title"           => $title,
                "year_of_release" => $year_of_release,
                "duration"        => $duration,
                "id_director"     => $id_director,
                "id_film"         => $id
            ]);

            // Gestion des genres
            if (isset($_POST["genres"])) {
                // Supprime les anciens genres liés au film
                $requete = $pdo->prepare(
                    "DELETE FROM classified 
                     WHERE id_film = :id_film"
                );
                $requete->execute(["id_film" => $id]);

                // Ajoute les nouveaux genres sélectionnés
                foreach ($_POST["genres"] as $id_genre) {
                    $requete = $pdo->prepare(
                        "INSERT INTO classified (id_film, id_genre)
                         VALUES (:id_film, :id_genre)"
                    );
                    $requete->execute([
                        "id_film"  => $id,
                        "id_genre" => $id_genre
                    ]);
                }
            }

            // Redirection vers les détails du film
            header("Location: index.php?action=detFilm&id=$id");
        }
    }
}
/**/