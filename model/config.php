<?php 

session_start();

require_once __DIR__ . "/../vendor/autoload.php";

define("PATH_BDD", __DIR__."/../db.sqlite");

if(!file_exists(PATH_BDD)){
  file_put_contents(PATH_BDD, NULL);
}

$db = new PDO("sqlite:".PATH_BDD);

$requete =<<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL,
    secret VARCHAR(255) DEFAULT NULL 
)
SQL;

$db->exec($requete);