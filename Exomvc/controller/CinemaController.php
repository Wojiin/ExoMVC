<?php

namespace Controller;
use model\Connect;

class CinemaController {
    /**
     * Lister des films
     */
    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
        SELECT titre, annee_sortie
        FROM film
        ");
        require "view/listFilms.php";
    }
}