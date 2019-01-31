<?php

declare(strict_types=1);

include 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new Http\Factory\Diactoros\ResponseFactory;

$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$router   = (new League\Route\Router)->setStrategy($strategy);

// map a route
$router->map('GET', '/', function (ServerRequestInterface $request) : array {
    return [
        'title'   => 'My New Simple API',
        'version' => 1,
    ];
});

$response = $router->dispatch($request);

// send the response to the browser
(new Zend\Diactoros\Response\SapiEmitter)->emit($response);