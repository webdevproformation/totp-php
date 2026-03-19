<?php 
require_once(__DIR__. "/config.php");

if(empty($_POST['email']) || empty($_POST['password']))
{
    die("identifiants manquants");
}

$email = $_POST["email"];
$passwordHashed = password_hash($_POST["password"],PASSWORD_BCRYPT);

$q = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
$q->bindValue("email" , $email);
$q->bindValue("password" , $passwordHashed);
$res = $q->execute();

if($res){
    echo "Inscription Réussie";
}
