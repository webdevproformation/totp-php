<?php
require_once(__DIR__. "/model/config.php");
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

</head>
<body>
    <div class="container">

        <h1>Register</h1>
        <form action="/model/register.php" method="POST">
            <input type="text" name="email" placeholder="email"><br>
            <input type="password" name="password" placeholder="password"><br>
            <button type="submit">Inscription</button>
        </form>
        <hr>

        <h1>Login</h1>
        <form action="/model/login.php" method="POST">
            <input type="text" name="email" placeholder="email"><br>
            <input type="password" name="password" placeholder="password"><br>
            <input type="text" name="tfa_code" placeholder="code 2fa"><br>
            <button type="submit">Connexion</button>
        </form>
    </div>
</body>
</html>