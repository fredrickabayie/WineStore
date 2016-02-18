<?php
/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 08/02/2016
 * Time: 11:24
 */

require_once '../vendor/autoload.php';
Twig_Autoloader::register();
//Twig

$loader = new Twig_Loader_Filesystem('');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('');
$params = array(
    'aName' => 'Oh yeah'
);

$template->display($params);