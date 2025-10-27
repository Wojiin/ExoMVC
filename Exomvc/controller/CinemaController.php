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
            "SELECT title, year_of_release
            FROM film"
        );
        require "view/listFilms.php";
    }
    /*
     * Détails d'un film
     */
    public function detFilm($id) {
        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.duration, p.first_name, p.last_name
            FROM film f
            INNER JOIN director d ON d.id_director = f.id_director
            INNER JOIN person p ON p.id_person = d.id_person
            WHERE f.id_film = :id"
        );
        $requeteFilm->execute(["id" => $id]);
        $requeteCasting = $pdo->prepare(
            "SELECT p.first_name, p.last_name, fr.character_first_name, fr.character_last_name
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
    /*
     * Détails d'un acteur
     */
        public function detActor($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday
            FROM person p
            INNER JOIN actor a ON a.id_person = p.id_person
            WHERE a.id_actor = :id"
        );
        $requete->execute(["id" => $id]);
        require "view/detActor.php";
    }
}