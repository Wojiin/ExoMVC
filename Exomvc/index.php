<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){

    switch ($_GET["action"]){
        //Films
        case "listFilms" : $ctrlCinema->listFilms(); 
        break;
        case "detFilm" : $ctrlCinema->detFilm($id);
        break;
        case "detActor" : $ctrlCinema->detActor($id);
        default : 
    }
}