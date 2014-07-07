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
    'host'      => '127.0.0.1',
    'port'	=> 3306,
    'database'  => 'mulicu',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'	=> '',
));
$capsule->setAsGlobal();
$capsule->bootEloquent();


// Routes

$app->get('/', function () use ($app) {
	echo "Rien";
});


$app->get('/curators/', function () {
    $curators = Curator::all();
    #echo $curators>toJson();
});

$app->get('/generate/', function () use ($app) {
	for ($i = 1; $i<=10; $i++) {
		$user = new User();
		$user->email = $i."@gmail.com";
		$user->save();
	}
    echo "generated";
});
/**********
* Admin
**********/

# Listing existing objects
$app->get('/admin/users/list/', function () {
	$users = User::all();
	echo $users->toJson();
});
$app->get('/admin/users/:id', function($id) use ($app) {
	$user = User::where('id', '=', $id)->get() ;
	echo $user->toJson();
});

/***** Articles ***/
$app->get('/admin/articles/list/json', function () {
	$articles = Article::all();
	echo $articles>toJson();
});
$app->get('/admin/articles/list/', function () use($app){
	$articles = Article::all();
	$app -> render('admin/articles.html', array('articles' => $articles));
})->name('admin_list_articles');

$app->get('/admin/articles/new/', function () use($app){
	$app -> render('admin/articles_new.html');
})->name('admin_add_new_article');

$app->post('/admin/articles/new/(:content)', function () use($app){
	echo $app->request->post('content');
	$app -> render('admin/articles_new.html');
});

# Installation
$app->get('/install_schema/', function () use ($app) {
	require 'install/schemas.php';
	echo "Schemas installed";
});

$app->run();
