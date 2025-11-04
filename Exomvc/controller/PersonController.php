<?php

namespace Controller;

use Model\Connect;

// Contrôleur pour gérer les acteurs et réalisateurs
class PersonController {

    /*
     * Liste tous les acteurs
     */
    public function listActors() {
        $pdo = Connect::seConnecter();

        // Récupère les informations des acteurs et leur ID
        $requete = $pdo->query(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday, a.id_actor
             FROM person p
             INNER JOIN actor a ON a.id_person = p.id_person"
        );

        // Charge la vue de la liste des acteurs
        require "view/listActors.php";
    }

    /*
     * Supprime un acteur
     */
    public function deleteActor($id) {
        $pdo = Connect::seConnecter();

        // Prépare la requête pour supprimer un acteur par son ID
        $requete = $pdo->prepare(
            "DELETE FROM actor 
             WHERE id_actor = :id"
        );
        $requete->execute(["id" => $id]);

        // Redirige vers la liste des acteurs après suppression
        header("Location:index.php?action=listActors");

        // Charge la vue de la liste des acteurs
        require "view/listActors.php";
    }

    /*
     * Liste tous les réalisateurs
     */
    public function listDirectors() {
        $pdo = Connect::seConnecter();

        // Récupère les informations des réalisateurs et leur ID
        $requete = $pdo->query(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday, d.id_director
             FROM person p
             INNER JOIN director d ON d.id_person = p.id_person"
        );

        // Charge la vue de la liste des réalisateurs
        require "view/listDirectors.php";
    }

    /*
     * Supprime un réalisateur
     */
    public function deleteDirector($id) {
        $pdo = Connect::seConnecter();

        // Prépare la requête pour supprimer un réalisateur par son ID
        $requete = $pdo->prepare(
            "DELETE FROM director 
             WHERE id_director = :id"
        );
        $requete->execute(["id" => $id]);

        // Redirige vers la liste des réalisateurs après suppression
        header("Location:index.php?action=listDirectors");

        // Charge la vue de la liste des réalisateurs
        require "view/listDirectors.php";
    }

    /*
     * Détails d'un acteur
     */
    public function detActor($id) {
        $pdo = Connect::seConnecter();

        // Récupère les informations personnelles de l'acteur
        $requeteActeur = $pdo->prepare(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday
             FROM person p
             INNER JOIN actor a ON a.id_person = p.id_person
             WHERE a.id_actor = :id"
        );
        $requeteActeur->execute(["id" => $id]);

        // Récupère la carrière de l'acteur : films et rôles
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

        // Charge la vue du détail de l'acteur
        require "view/detActor.php";
    }

    /*
     * Détails d'un réalisateur
     */
    public function detDirector($id) {
        $pdo = Connect::seConnecter();

        // Récupère les informations personnelles du réalisateur
        $requeteDirector = $pdo->prepare(
            "SELECT p.first_name, p.last_name, p.gender, p.birthday
             FROM person p
             INNER JOIN director d ON d.id_person = p.id_person
             WHERE d.id_director = :id"
        );
        $requeteDirector->execute(["id" => $id]);

        // Récupère la filmographie du réalisateur
        $requeteFilmo = $pdo->prepare(
            "SELECT f.title, f.year_of_release, f.id_film
             FROM film f
             INNER JOIN director d ON d.id_director = f.id_director
             WHERE d.id_director = :id"
        );
        $requeteFilmo->execute(["id" => $id]);

        // Charge la vue du détail du réalisateur
        require "view/detDirector.php";
    }

}
