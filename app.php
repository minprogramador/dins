<?php

use Dins\facil\Init;
use Dins\facil\Cookie;

use Dins\facil\Consultar;

require_once 'vendor/autoload.php';

$init = new Init();
$cc   = new Cookie();

$check_sessao = $init->run();

if(stristr($check_sessao, 'PHPSESSID')) {
	$config = parse_ini_file(".env");
}

if(isset($config)) {

	$url = 'http://www.consultefacil.org/Servicos/ExtratoConsignacoes';

	$consult = new Consultar();
	$consult->setUrl($url);
	$consult->setCookie($config['COOKIE_API']);
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







// header('Content-Type: application/pdf');
// header('Content-Disposition: attachment;'); 

