<?php

// Catégorise virtuellement la classe
namespace Controller;

// Récupère la PDO (PHP Data Objects)
use Model\Connect;

// Contrôleur de la page d'accueil
class HomeController {

    /*
     * Affiche la page d'accueil avec la liste des genres
     */
    public function accueil() {  
        // Connexion à la base de données
        $pdo = Connect::seConnecter();

        // Récupère tous les genres
        $requete = $pdo->query(
            "SELECT wording, id_genre
             FROM genre"
        );    

        // Charge la vue associée à l'accueil
        require "view/accueil.php";
    }

}