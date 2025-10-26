<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name){
    incluude $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch ($_get["action"]){

        case "listFilms" : $ctrlCinema->listFilms(); 
        break;
        case "listActeurs" : $ctrlCinema->listActeurs();
        break;
    }
}