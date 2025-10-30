<?php

namespace Controller;

use Model\Connect;

class CinemaController {
    /*
     * Lister des films
     */
    public function listFilms() {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(
            "SELECT title, year_of_release, id_film
            FROM film"
        );
        require "view/listFilms.php";
    }

    /*
     * Lister des films par genre
     */
    public function listFilmsByGenre($id) {
        
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.id_film, g.wording
            FROM genre g
            INNER JOIN classified cl ON cl.id_genre = g.id_genre
            INNER JOIN film f ON f.id_film = cl.id_film
            WHERE g.id_genre = :id"
        );
        $requete->execute(["id" => $id]);
        require "view/listFilmsByGenre.php";
    }
    /*
     * Détails d'un film
     */
    public function detFilm($id) {
        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.duration, f.id_film, f.id_director, p.first_name, p.last_name
            FROM film f
            INNER JOIN director d ON d.id_director = f.id_director
            INNER JOIN person p ON p.id_person = d.id_person
            WHERE f.id_film = :id"
        );
        $requeteFilm->execute(["id" => $id]);
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
        require "view/detFilm.php";
    }
}