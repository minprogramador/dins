<?php

use Dins\facil\Init;
use Dins\facil\Cookie;

require_once 'vendor/autoload.php';

$init = new Init();

$check_sessao = $init->run();
if(stristr($check_sessao, 'PHPSESSID')) {
	echo "\n========================\n";
	$configw = parse_ini_file(".env");
	print_r($configw);
}else{
	echo "sem sessao.";
}








