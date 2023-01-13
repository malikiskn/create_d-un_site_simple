<?php

/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once("view/View.php");
require_once("control/Controller.php");
require_once("model/Article.php");
require_once("model/ArticleStorage.php");
require_once("model/ArticleBuilder.php");
require_once("model/ArticleStorageMySQL.php");
/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son fonction main.
 */
try {
    $db = new PDO('mysql:host=localhost;dbname=tests;charset=utf8', 'root', '');
} catch (Exception $e) {
    print "Erreur :".$e->getMessage();
    die;
}
$router = new Router(new ArticleStorageMySQL($db));
$router->main();

?>