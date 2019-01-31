<?php

declare(strict_types=1);

namespace Dins;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

use Dins\facil\Init;
use Dins\facil\Cookie;
use Dins\facil\Check;

class consultarController
{

    public function run(ServerRequestInterface $request, $n) : ResponseInterface {
	    $response = new Response;

	    $response->getBody()->write(json_encode(['doc' => $n]));
	    return $response;
	}

}


