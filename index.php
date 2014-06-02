<?php

require 'vendor/autoload.php';

/************  Configuration ****************/
	// Application Definition and configuration
	$app = new \Slim\Slim();
	$app->config(array(
		'debug' => true,
		'templates.path' => 'templates',
		'view' => new \Slim\Views\Twig()
	));
    $view = $app->view();
    $view->parserExtensions = array(
        new \Slim\Views\TwigExtension(),
    );

// Make a new connection
use Illuminate\Database\Capsule\Manager as Capsule;  
 
$capsule = new Capsule;
 
$app->db = $capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'test',
    'username'  => 'test',
    'password'  => 'l4m3p455w0rd!',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
));
/*
$app->db = Capsule\Database\Connection::make('default', array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => 3306,
    'database' => 'mulicu',
    'username' => 'root',
    'password' => '',
    'prefix' => '',
    'charset' => "utf8",
    'collation' => 'utf8_general_ci'
), true);*/

// Routes

$app->get('/', function () use ($app) {
	echo "Rien";
});


$app->get('/curators/', function () {
    $curators = Curator::all();
    echo $curators>toJson();
});

$app->get('/generate', function () {
	for ($i = 1; $i<=10; $i++) {
		$curator = new Curator();
		$oScore->save();
	}
    echo "generated";
});

$app->run();