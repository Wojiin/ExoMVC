<?php

namespace Controller;

use Model\Connect;

class HomeController {
public function accueil() {  
    $pdo = Connect::seConnecter();
    $requete = $pdo->query(
        "SELECT wording, id_genre
        FROM genre"
        );    
    require "view/accueil.php";
    }

}