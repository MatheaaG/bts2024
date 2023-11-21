<?php

require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('views/');
$twig = new \Twig\Environment($loader);

//echo "Connexion MYSQL";
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=BTS_Mathea;charset=utf8',
        'mathea',
        'plop'
    );
}
catch (Exception $e){
    die("Erreur : ".$e->getMessage());
}
$dataStatut = $db->prepare('SELECT * FROM user');
$dataStatut->execute();
$datas=$dataStatut->fetchAll();

echo $twig->render('users.html', ['users'=>$datas]);


?>