<?php

require 'vendor/autoload.php';

// Setup custom Twig view
$twigView = new \Slim\Extras\Views\Twig();

$app = new \Slim\Slim(array(
	'debug' => true,
	'view' => $twigView,
	'templates.path' => '/templates/',
));



$app->get('/', function () use ($app) {
	echo "Rien";
});

$app->run();