<?php

/*namespace agit comme un mot-clé qui permet de catégoriser virtuellement une classe, une interface,
 une fonction, une constante(Si plusieurs 
 classes possèdent le même nom, on se réfère au namespace). 
 Ici, il nous permet d'accéder à " Connect " sans passer par son emplacement
 physique
*/ 
namespace Model;

abstract class Connect {
    const HOST = "localhost";
    const DB = "cinema_quentin";
    const USER = "root";
    const PASS = "";

    //PDO ( PHP Data Objects) est une interface qui permet d'accéder à une base de données depuis PHP.
    public static function seConnecter() {
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";
                dbname=".self::DB.";
                charset=utf8", self::USER, self::PASS
            );
            //Préviens d'une erreur de typing
        } catch(\PDOException $ex) {
            return $ex->getMessage();
        }
    }
}