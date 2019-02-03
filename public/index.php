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

$router->map('GET', '/', 'controllers\indexController::run');

$router->map('GET', '/status', 'controllers\indexController::status');

$router->map('GET', '/consultar', 'controllers\indexController::run');

$router->map('GET', '/consultar/{n}', 'controllers\consultarController::run');

$router->map('GET', '/consultar/extrato/{n}', 'controllers\consultarController::extrato');


//run
$response = $router->dispatch($request);
$server->emit($response);