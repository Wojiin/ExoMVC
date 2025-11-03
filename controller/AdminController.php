<?php

// Catégorise virtuellement la classe
namespace Controller;

// Récupère la PDO ( PHP Data Objects)
use Model\Connect;

// Définit la classe 
class AdminController {

public function ajouterGenre() {

    // Utilise la PDO pour se connecter à la base de données
    $pdo = Connect::seConnecter();

    // Si le formulaire est soumis, le nettoie au travers d'un filtre et récupère les données sous la forme d'une variable
    if (isset($_POST['submit'])) { 
        $wording = filter_input(INPUT_POST, "wording", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Si une variable est définie, on ajoute sa valeur comme un nouveau genre
        if ($wording) {

            // Initialise la requête contenant un identifiant
            $requete = $pdo->prepare(
                "INSERT INTO genre (wording) 
                 VALUES (:wording)"
                 );
                 // La
                 // nce la requête
                 $requete->execute(["wording" => $wording]
                );
            }
        }

    // Le controller est actif sur la vue " ajouter.php "
    require "view/ajouter.php";
    }

public function ajouterFilm() {
    $pdo = Connect::seConnecter();

    // Si le formulaire est soumis, le nettoie au travers d'un filtre et récupère les données sous la forme de variables
    if (isset($_POST['submit'])) {
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $year_of_release = filter_input(INPUT_POST, "year_of_release", FILTER_SANITIZE_NUMBER_INT);
        $duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_NUMBER_INT);
        $id_director = filter_input(INPUT_POST, "id_director", FILTER_SANITIZE_NUMBER_INT);


        if ($title && $year_of_release && $duration && $id_director) {
            $requete = $pdo->prepare(
                "INSERT INTO film (title, year_of_release, duration, id_director)
                VALUES (:title, :year_of_release, :duration, :id_director)"
            );
            $requete->execute([
                "title" => $title,
                "year_of_release" => $year_of_release,
                "duration" => $duration,
                "id_director" => $id_director]
            );

            $idFilm = $pdo->lastInsertId();

            if (isset($_POST["genres"])) {
                foreach ($_POST["genres"] as $id_genre) {
                    $requeteGenre = $pdo->prepare(
                        "INSERT INTO classified (id_film, id_genre)
                        VALUES (:id_film, :id_genre)"
                    );
                    $requeteGenre->execute([
                        "id_film" => $idFilm,
                        "id_genre" => $id_genre]
                    );
                    }
                }
            }
        }
    require "view/ajouter.php";
    }

    
public function ajouterPerson() {
    $pdo = Connect::seConnecter();

    if (isset($_POST['submit'])) { 
        $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $birthday = filter_input(INPUT_POST, "birthday", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Si " Acteur " est coché, il vaut 1 sinon 0
        if (isset($_POST["isActor"])) {
            $isActor = 1;
        } else {
            $isActor = 0;
        }

        // Si " Réalisateur " est coché, il vaut 1 sinon 0
        if (isset($_POST["isDirector"])) {
            $isDirector = 1;
        } else {
            $isDirector = 0;
        }

        // Si le formulaire est complet et ses données filtrées et si " Acteur " et/ou " Réalisateur " vaut 1
        if ($first_name && $last_name && $gender && $birthday && ($isActor == 1 || $isDirector == 1)) {

            // Ajoute à la base de données 
            $requete = $pdo->prepare("
                INSERT INTO person (first_name, last_name, gender, birthday)
                VALUES (:first_name, :last_name, :gender, :birthday)"
            );
            $requete->execute([
                "first_name" => $first_name,
                "last_name" => $last_name,
                "gender" => $gender,
                "birthday" => $birthday]
            );

            // Défini la variable contenant le dernier identifiant enregistré via ajouterPerson()
            $idPerson = $pdo->lastInsertId();

            // Si " Acteur " = 1, la personne est enregistrée comme Acteur
            if ($isActor == 1) {
                $requeteActeur = $pdo->prepare("
                    INSERT INTO actor (id_person)
                    VALUES (:id_person)"
                );
                $requeteActeur->execute(["id_person" => $idPerson]);
            }
            
            // Si " Réalisateur " = 1, la personne est enregistrée comme Réalisateur
            if ($isDirector == 1) {
                $requeteRealisateur = $pdo->prepare(
                    "INSERT INTO director (id_person)
                    VALUES (:id_person)"
                );
                $requeteRealisateur->execute(["id_person" => $idPerson]);
                }
            }
        }
    require "view/ajouter.php"; 
    }
}
