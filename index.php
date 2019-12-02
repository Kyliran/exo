<?php

/**
 * Index.php sert de point central. C'est lui qui reçoit toutes les requêtes.
 * Pour chaque requête, on va charger toutes les classses de notre projet
 */

include 'App.php';
include 'Controller.php';
include 'View.php';

$app = new App();

$route = $app->getRoute();

$app->dispatchRoute($route);