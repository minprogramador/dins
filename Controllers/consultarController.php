<?php

declare(strict_types=1);

namespace controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

use Dins\facil\Init;
use Dins\facil\Cookie;
use Dins\facil\Check;
use Dins\facil\Consultar;


class consultarController
{

    public function run(ServerRequestInterface $request, $n) : ResponseInterface {
	    $response = new Response;

	    $response->getBody()->write(json_encode(['doc' => $n]));
	    return $response;
	}


    public function extrato(ServerRequestInterface $request, $n) : ResponseInterface {
		if(isset($n['n'])) {
			$nb = $n['n'];
			if(strlen($nb) < 2) { die(':('); }
		}else{
			die(':(');
		}

		$init = new Init();
		$cc   = new Cookie();
		$check_sessao = $init->run();

		if(is_string($check_sessao) AND stristr($check_sessao, 'PHPSESSID')) {
			$config = parse_ini_file("../.env");
		}

		if(isset($config)) {

			$url = 'http://www.consultefacil.org/Servicos/ExtratoConsignacoes';
			
			$consult = new Consultar();
			$consult->setUrl($url);
			$consult->setCookie($config['COOKIE_API']);
			$consult->setNb($nb);
			$res = $consult->run();

			if($res == 5) {

				$res = [
					'msg' => 'erro na comunicacao com o dataprev, tente novamente em breve.'
				];

			}elseif($res === false) {
				$cc->del();

				$res = [
					'msg' => 'erro ao consultar, tente novamente'
				];

			}elseif($res == 8) {

				$cc->del();

				$res = [
					'msg' => 'erro indefinico :('
				];


			}elseif(strlen($res) > 200) {

				$res = [
					'msg' => 'Ok',
					'pdf' => base64_encode($res)
				];

			}else{
				$cc->del();

				$res = [
					'msg' => 'erro indefinido, tente novamente em breve.'
				];

			}
		}else {
			$cc->del();

			$res = [
				'msg' => "relogar, sem sessao."
			];
		}










	    $response = new Response;
	    $response->getBody()->write(json_encode(['doc' => $n, 'res' => $res]));
	    return $response;
	}

}


