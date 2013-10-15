<?php

use Composer\Factory;
use Composer\IO\NullIO;
use Rabus\Composer\WebUI\Controller\MainController;
use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = new Application;
$app->register(new ServiceControllerServiceProvider());

// Services
$app['composer'] = function()
{
    $factory = new Factory;
    return $factory->create(new NullIO);
};

$app['controllers.main'] = function ($app)
{
    return new MainController($app['composer']);
};

// Routes
$app->get('/', 'controllers.main:indexAction');

// Run it!
$app->run();
