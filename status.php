<?php

use Dins\facil\Init;
use Dins\facil\Cookie;

use Dins\facil\Check;

require_once 'vendor/autoload.php';

$init = new Init();
$cc   = new Cookie();

$check_sessao = $init->run();

if(stristr($check_sessao, 'PHPSESSID')) {
	$config = parse_ini_file(".env");
}

if(isset($config)) {

	$url = 'http://www.consultefacil.org/Painel';

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
	$cc->del();

	$res = [
		'msg' => "relogar, sem sessao."
	];
}

header("Content-type:application/json");
echo json_encode($res);
die;






// header('Content-Type: application/pdf');
// header('Content-Disposition: attachment;'); 

