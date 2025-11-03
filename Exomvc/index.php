<?php

use Controller\CinemaController;
use Controller\AdminController;
use Controller\HomeController;
use Controller\PersonController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlAdmin = new AdminController();
$ctrlHome = new HomeController();
$ctrlPerson = new PersonController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){

    switch ($_GET["action"]){

        // Films

        case "listFilms": $ctrlCinema->listFilms();
        break;
        case "listFilmsByGenre": $ctrlCinema->listFilmsByGenre($id); 
        break;
        case "detFilm": $ctrlCinema->detFilm($id); 
        break;
        case "ajouterRole" : $ctrlCinema->ajouterRole();
        break;
        case "supprFilm" : $ctrlCinema->supprFilm($id);
        break;
        // Personnes

        case "listActors": $ctrlPerson->listActors(); 
        break; 
        case "detActor": $ctrlPerson->detActor($id); 
        break;
        case "listDirectors": $ctrlPerson->listDirectors(); 
        break;
        case "detDirector": $ctrlPerson->detDirector($id); 
        break;

        // Accueil

        case "accueil": $ctrlHome->accueil(); break;

        // Admin
        case "ajouter": require "view/ajouter.php";
        break;
        case "ajouterGenre": $ctrlAdmin->ajouterGenre();
        break;
        case "ajouterFilm": $ctrlAdmin->ajouterFilm();
        break;
        case "ajouterPerson": $ctrlAdmin->ajouterPerson();
        break;
    }

}