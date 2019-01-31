<?php

declare(strict_types=1);

namespace Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;


use Dins\facil\Init;
use Dins\facil\Cookie;
use Dins\facil\Check;

class indexController
{

    public function run(ServerRequestInterface $request) : ResponseInterface {
	    $response = new Response;

	    $response->getBody()->write(json_encode(['msg' => ':(']));
	    return $response;
	}

    public function status(ServerRequestInterface $request) : ResponseInterface {

		$init = new Init();
		$cc   = new Cookie();

		$check_sessao = $init->run();

		if ($check_sessao !== false) {
			if(stristr($check_sessao, 'PHPSESSID')) {
				$config = parse_ini_file("../.env");
			}
		}

		if(isset($config)) {

			$url = $config['URL_API']. 'Painel';

			$check = new Check();
			$check->setUrl($url);
			$check->setCookie($config['COOKIE_API']);
			$rr = $check->run();
			if($rr === true) {
				$res = [
					'msg' => 'Online'
				];
			}elseif($rr === false) {
				$res = [
					'msg' => 'Off-line'
				];
			}else {
				$res = [
					'msg' => 'erro indefinido, verificar.'
				];
			}
		}else {
		//	$cc->del();

			$res = [
				'msg' => "relogar, sem sessao."
			];
		}

	    $response = new Response;
	    $response->getBody()->write(json_encode($res));
	    return $response;

	}

}


