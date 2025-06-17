<?php
require_once './vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader ('./templates');
$twig = new \Twig\Environment ($loader);

$pais = [
    "espania" =>
    [
        "nombre" => "Espania",
        "lengua" => "Espaniol",
        "moneda" => "Euro",
    ],
    "alemania" =>
    [
        "nombre" => "Alemania",
        "lengua" => "Aleman",
        "moneda" => "Euro",
    ],
    "argentina" =>
    [
        "nombre" => "Argentina",
        "lengua" => "Espaniol",
        "moneda" => "Peso Argentino",
    ],
    "brasil" =>
    [
        "nombre" => "Brasil",
        "lengua" => "Portgues",
        "moneda" => "Real",
    ],
    "usa" =>
    [
        "nombre" => "Estados Unidos",
        "lengua" => "Ingles",
        "moneda" => "Dolar",
    ]              
];

echo $twig->render('ejer3.html.twig', ['paises' => $pais]);

?>