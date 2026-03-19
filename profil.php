<?php 
use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\Providers\Qr\QRServerProvider; // if using library's provider

require_once(__DIR__. "/model/config.php");

if(empty($_SESSION["user_id"])){
    header("location:/");
    exit();
}

$q = $db->prepare('SELECT * FROM users WHERE id = :id');
$q->bindValue("id" , $_SESSION["user_id"]);
$q->execute();
$user = $q->fetch(PDO::FETCH_ASSOC);

$tfa = new TwoFactorAuth(new QRServerProvider(), "Your app name");

if(empty($_SESSION["tfa_code"])){
    $_SESSION["tfa_code"] = $tfa->createSecret();
}

$secret = $_SESSION["tfa_code"];


?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre profil</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

</head>
<body>
    <div class="container">
        <h1>votre profil</h1>
        <a href="/model/logout.php">logout</a>
        <pre>
<?php var_dump($user) ?>
        </pre>

        <h2>Action la 2fa</h2>
        <?php if(!empty($user["secret"])) : ?>
            <p><code>2fa activée pour cet utilisateur</code></p>
            <?php else : ?>
             <p><code>2fa non activée pour cet utilisateur</code></p>   
        <?php endif ?>
        <p>Please enter the following code in your app: '<?php echo $secret; ?>'</p>
        <img src="<?= $tfa->getQRCodeImageAsDataUri($user["email"] , $secret ) ?>" alt="">
        <form action="/model/register-2fa.php" method="POST">
            <input type="text" name="tfa_code" placeholder="Code">
            <button type="submit">Valider</button>
        </form>
    </div>
</body>
</html>