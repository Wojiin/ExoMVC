<?php

namespace Controller;

use Model\Connect;

class AdminController {

public function ajouterGenre() {
    $pdo = Connect::seConnecter();

    if (isset($_POST['submit'])) { 
        $wording = filter_input(INPUT_POST, "wording", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($wording) {
            $requete = $pdo->prepare(
                "INSERT INTO genre (wording) 
                 VALUES (:wording)"
                 );
                 $requete->execute(["wording" => $wording]
                );
            }
        }
    require "view/ajouter.php";
    }

public function ajouterFilm() {
    $pdo = Connect::seConnecter();

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

        if (isset($_POST["isActor"])) {
            $isActor = 1;
        } else {
            $isActor = 0;
        }

        if (isset($_POST["isDirector"])) {
            $isDirector = 1;
        } else {
            $isDirector = 0;
        }

        if ($first_name && $last_name && $gender && $birthday && ($isActor == 1 || $isDirector == 1)) {
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

            $idPerson = $pdo->lastInsertId();

            if ($isActor == 1) {
                $requeteActeur = $pdo->prepare("
                    INSERT INTO actor (id_person)
                    VALUES (:id_person)"
                );
                $requeteActeur->execute(["id_person" => $idPerson]);
            }

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
