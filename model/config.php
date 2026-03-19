<?php 

session_start();

require_once __DIR__ . "/../vendor/autoload.php";

$db = new PDO("sqlite:".__DIR__."/../db.sqlite");