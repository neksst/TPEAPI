<?php
require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';


// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('peliculas', 'GET', 'ApiController', 'getMovies');
$router->addRoute('test', 'GET', 'ApiController', 'test');
$router->addRoute('peliculas', 'POST', 'ApiController', 'AddMovie');
$router->addRoute('peliculas/:ID', 'GET', 'ApiController', 'getMovie');
$router->addRoute('peliculas/:ID','PUT','ApiController','EditMovie');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);