<?php

// Catégorise virtuellement la classe
namespace Controller;

// Récupère la PDO (PHP Data Objects)
use Model\Connect;

// Définit la classe AdminController
class AdminController {

    // Méthode pour ajouter un genre
    public function ajouterGenre() {

        // Se connecte à la base de données via PDO
        $pdo = Connect::seConnecter();

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) { 
            // Nettoie et récupère la valeur du champ wording
            $wording = filter_input(INPUT_POST, "wording", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Si le champ wording n'est pas vide, on ajoute le genre
            if ($wording) {

                // Prépare la requête d'insertion
                $requete = $pdo->prepare(
                    "INSERT INTO genre (wording) 
                     VALUES (:wording)"
                );

                // Exécute la requête avec la valeur filtrée
                $requete->execute(["wording" => $wording]);
            }
        }

        // Affiche la vue associée au formulaire
        require "view/ajouter.php";
    }

    // Méthode pour ajouter un film
    public function ajouterFilm() {
        $pdo = Connect::seConnecter();

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            // Récupère et filtre les données du formulaire
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $year_of_release = filter_input(INPUT_POST, "year_of_release", FILTER_SANITIZE_NUMBER_INT);
            $duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_NUMBER_INT);
            $id_director = filter_input(INPUT_POST, "id_director", FILTER_SANITIZE_NUMBER_INT);

            // Si tous les champs obligatoires sont remplis
            if ($title && $year_of_release && $duration && $id_director) {
                // Prépare la requête d'insertion dans la table film
                $requete = $pdo->prepare(
                    "INSERT INTO film (title, year_of_release, duration, id_director)
                     VALUES (:title, :year_of_release, :duration, :id_director)"
                );

                // Exécute la requête avec les valeurs filtrées
                $requete->execute([
                    "title" => $title,
                    "year_of_release" => $year_of_release,
                    "duration" => $duration,
                    "id_director" => $id_director
                ]);

                // Récupère l'identifiant du film nouvellement créé
                $idFilm = $pdo->lastInsertId();

                // Si des genres ont été sélectionnés
                if (isset($_POST["genres"])) {
                    // Parcourt chaque genre sélectionné et l'associe au film
                    foreach ($_POST["genres"] as $id_genre) {
                        $requeteGenre = $pdo->prepare(
                            "INSERT INTO classified (id_film, id_genre)
                             VALUES (:id_film, :id_genre)"
                        );
                        $requeteGenre->execute([
                            "id_film" => $idFilm,
                            "id_genre" => $id_genre
                        ]);
                    }
                }
            }
        }

        // Affiche la vue associée au formulaire
        require "view/ajouter.php";
    }

    // Méthode pour ajouter une personne
    public function ajouterPerson() {
        $pdo = Connect::seConnecter();

        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) { 
            // Récupère et filtre les données du formulaire
            $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $birthday = filter_input(INPUT_POST, "birthday", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Définit si la personne est un acteur
            $isActor = isset($_POST["isActor"]) ? 1 : 0;

            // Définit si la personne est un réalisateur
            $isDirector = isset($_POST["isDirector"]) ? 1 : 0;

            // Si le formulaire est complet et que la personne est acteur et/ou réalisateur
            if ($first_name && $last_name && $gender && $birthday && ($isActor == 1 || $isDirector == 1)) {

                // Prépare la requête d'insertion dans la table person
                $requete = $pdo->prepare(
                    "INSERT INTO person (first_name, last_name, gender, birthday)
                     VALUES (:first_name, :last_name, :gender, :birthday)"
                );

                // Exécute la requête avec les valeurs filtrées
                $requete->execute([
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "gender" => $gender,
                    "birthday" => $birthday
                ]);

                // Récupère l'identifiant de la personne nouvellement créée
                $idPerson = $pdo->lastInsertId();

                // Si la personne est un acteur, l'enregistre dans la table actor
                if ($isActor == 1) {
                    $requeteActeur = $pdo->prepare(
                        "INSERT INTO actor (id_person)
                         VALUES (:id_person)"
                    );
                    $requeteActeur->execute(["id_person" => $idPerson]);
                }

                // Si la personne est un réalisateur, l'enregistre dans la table director
                if ($isDirector == 1) {
                    $requeteRealisateur = $pdo->prepare(
                        "INSERT INTO director (id_person)
                         VALUES (:id_person)"
                    );
                    $requeteRealisateur->execute(["id_person" => $idPerson]);
                }
            }
        }

        // Affiche la vue associée au formulaire
        require "view/ajouter.php"; 
    }
}
