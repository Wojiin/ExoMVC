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
        //Films
        case "listFilms" : $ctrlCinema->listFilms(); 
        break;
        case "listGenres" : $ctrlCinema->listGenres();
        break;
        case "listFilmsByGenre" : $ctrlCinema->listFilmsByGenre($id);
        break;
        case "detFilm" : $ctrlCinema->detFilm($id);
        break;
        //Personnes
        case "detActor" : $ctrlPerson->detActor($id);
        break;
        case "detDirector" : $ctrlPerson->detDirector($id);
        break;
        //Accueil
        case "accueil" : $ctrlHome->accueil();
        break;
    }
}