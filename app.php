<?php

use Dins\facil\Logar;
use Dins\facil\Cookie;
use Dins\facil\Check;

require_once 'vendor/autoload.php';

$config = parse_ini_file(".env");

$cc = new Cookie();
$cookie = $cc->find();

if(strlen($cookie) > 5) {

	$check = new Check();
	$check->setUrl('http://www.consultefacil.org/Painel');
	$check->setCookie($cookie);

	$ver_cookie = $check->run();
	if($ver_cookie === false) {
		$cc->del();
	}
}else{

	$ver_cookie = false;
}

if($ver_cookie === false) {

	$logar = new Logar();

	$logar->setUrl($config['URL_API']);
	$logar->setUsuario($config['USER_API']);
	$logar->setSenha($config['PASS_API']);

	$cookie = $logar->run();



	echo "na 34\n\n";
	print_r($cookie);

	if($cookie === false) {
		$cc->setCookie('');
	}else{
		$cc->setCookie($cookie);		
	}
	
	$cc->save();


	print_r($cookie);
	echo "\n========================\n";
	$configw = parse_ini_file(".env");
	print_r($configw);
//	die;
}
echo "na 59\n";
print_r($ver_cookie);
die;
