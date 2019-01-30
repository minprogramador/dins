<?php

use Dins\facil\Logar;
use Dins\facil\Cookie;

// use Api\Boa\Cnpj\Check as cnpjCheck;
// use Api\Boa\Cpf\Check as cpfCheck;

require_once 'vendor/autoload.php';

$config = parse_ini_file(".env");

// define('url_path', $config['url_path']);
// define('api_cpf',  $config['api_cpf']);
// define('proxy',    $config['proxy']);
// define('debug',    $config['debug']);
// define('ip_debug', $config['ip_debug']);
// define('status',   $config['status']);
// define('timeout',  $config['timeout']);


// $cc = new Cookie();
// $cookie = $cc->find();
// print_r($cookie);
// die;

// $cc->setCookie('PHPSESSID=r95t43krh5rkis6uh43r8u7j84');
// $a = $cc->save();
// print_r($a);

$logar = new Logar();
echo $config['URL_API'];
$logar->setUrl($config['URL_API']);
$logar->setUsuario($config['USER_API']);
$logar->setSenha($config['PASS_API']);

$cookie = $logar->run();
print_r($cookie);
// $cpfcon = new cpfCheck();
// $cpfcon->setCookie($cookie);
// $cpfcon->setProxy($proxy);
// $run = $cpfcon->check();
