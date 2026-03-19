<?php 
use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\QRServerProvider; // if using library's provider

require_once(__DIR__. "/config.php");

if(empty($_POST['email']) || empty($_POST['password']))
{
    die("identifiants manquants");
}
echo "<pre>";

var_dump($_POST);

$email = $_POST["email"];
$password = $_POST["password"];
$tfaCode = $_POST["tfa_code"];

$q = $db->prepare("SELECT * FROM users WHERE email = :email");
$q->bindValue("email" , $email);
$q->execute();
$user = $q->fetch(PDO::FETCH_ASSOC);

var_dump($user);

if(!$user){
     die("email user n'existe pas en base de données");
}

$passwordHash = $user["password"];

if(!password_verify( $password , $passwordHash  )){
    die("password user invalide");
}

$tfa = new TwoFactorAuth(new QRServerProvider(), "Your app name");

// si l'utilisateur a un code secret en base de données et qu'il le saisit
if(
    !empty($user["secret"])  && 
    !$tfa->verifyCode( $user["secret"] , $tfaCode)  
){
    die("code 2FA invalide");
}

$_SESSION["user_id"] = $user["id"];
header("location:/profil.php");
exit();