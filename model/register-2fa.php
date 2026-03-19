<?php 
use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\QRServerProvider; // if using library's provider

require_once(__DIR__. "/config.php");

if(empty($_POST['tfa_code']))
{
    die("tfa_code manquant");
}

$tfa = new TwoFactorAuth(new QRServerProvider(), "Your app name");

if( $tfa->verifyCode( $_SESSION["tfa_code"] , $_POST['tfa_code']) ){

    $q = $db->prepare('UPDATE users SET secret = :secret WHERE id = :id');
    $q->bindValue("secret", $_SESSION["tfa_code"]);
    $q->bindValue("id", $_SESSION["user_id"]);
    $q->execute();

    echo "code valide";
}else{

echo "code invalide";
}



