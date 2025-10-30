<?php

namespace Controller;

use Model\Connect;

class PersonController {
    /*
     * Détails d'un acteur
     */
        public function detActor($id) {
        $pdo = Connect::seConnecter();
        $requeteActeur = $pdo->prepare(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday
            FROM person p
            INNER JOIN actor a ON a.id_person = p.id_person
            WHERE a.id_actor = :id"
        );
        $requeteActeur->execute(["id" => $id]);
        $requeteCarriere = $pdo->prepare(
        "SELECT f.title, f.year_of_release, f.id_film, fr.character_first_name, fr.character_last_name
        FROM film f
        INNER JOIN play pl ON pl.id_film = f.id_film
        INNER JOIN film_role fr ON fr.id_role = pl.id_role
        INNER JOIN actor a ON a.id_actor = pl.id_actor
        INNER JOIN person p ON p.id_person = a.id_person
        WHERE pl.id_actor = :id"
        );
        $requeteCarriere->execute(["id" => $id]);
        require "view/detActor.php";
    }
    /*
     * Détails d'un réalisateur
     */
        public function detDirector($id) {
        $pdo = Connect::seConnecter();
        $requeteDirector = $pdo->prepare(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday
            FROM person p
            INNER JOIN director d ON d.id_person = p.id_person
            WHERE d.id_director = :id"
        );
        $requeteDirector->execute(["id" => $id]);
        $requeteFilmo = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.id_film
            FROM film f
            INNER JOIN director d ON d.id_director = f.id_director
            WHERE d.id_director = :id"
        );
        $requeteFilmo->execute(["id" => $id]);
        require "view/detDirector.php";
    }

}