<?php

declare(strict_types=1);

include '../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$server = new Zend\Diactoros\Response\SapiEmitter;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST
);

$router = new League\Route\Router;

$router->map('GET', '/', 'Controllers\indexController::run');

$router->map('GET', '/status', 'Controllers\indexController::status');

$router->map('GET', '/consultar', 'Controllers\indexController::run');

$router->map('GET', '/consultar/{n}', 'Controllers\consultarController::run');

//run
$response = $router->dispatch($request);
$server->emit($response);