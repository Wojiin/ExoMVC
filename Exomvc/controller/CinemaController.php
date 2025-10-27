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
    public function detFilm() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare(
            "SELECT f.title, f.year_of_release, DATE_FORMAT(SEC_TO_TIME(f.duration * 60), '%H:%i') AS duree, concat(p.first_name,' ', p.last_name) AS réalisateur
            FROM film f
            INNER JOIN director d ON d.id_director = f.id_director
            INNER JOIN person p ON p.id_person = d.id_person
            ORDER BY f.id_film
            WHERE id_film = :id"
        );
        $requet->execute(["id" => $id]);
        require "view/detFilm.php";
    }
}