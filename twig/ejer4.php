<?php
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader ('./templates');
$twig = new \Twig\Environment ($loader);

$numero = rand(0,1);

echo $twig->render('ejer4.html.twig', ['num' => $numero]);
?>