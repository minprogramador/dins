<?php

declare(strict_types=1);

include 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$server = new Zend\Diactoros\Response\SapiEmitter;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST
);

$router = new League\Route\Router;

$router->map('GET', '/', 'Dins\indexController::run');

$router->map('GET', '/status', 'Dins\indexController::status');

$router->map('GET', '/consultar', 'Dins\indexController::run');

$router->map('GET', '/consultar/{n}', 'Dins\consultarController::run');

//run
$response = $router->dispatch($request);
$server->emit($response);