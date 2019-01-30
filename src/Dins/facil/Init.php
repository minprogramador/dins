<?php

namespace Dins\facil;

use Dins\utils\Curl;
use Dins\utils\Util;

use Dins\facil\Logar;
use Dins\facil\Cookie;
use Dins\facil\Check;

use Dins\facil\Lock;


class Init {

    private $cookie;

    public function setCookie($cookie) {
        $this->cookie = $cookie;
    }

    public function getCookie() {
        return $this->cookie;
    }

    public function check() {
        
        $cookie = $this->cookie;

        $cc = new Cookie();

        if(strlen($cookie) > 5) {

            $config = $this->getInfo();

            $check = new Check();
            $check->setUrl($config['URL_API'].'Painel');
            $check->setCookie($cookie);

            $ver_cookie = $check->run();
            if($ver_cookie === false) {
                $cc->del();
            }
        }else{

            $ver_cookie = false;
        }

        return $ver_cookie;
    }

    public function getInfo() {
        $config = parse_ini_file(".env");
        return $config;
    }

    public function logar() {

        $cc    = new Cookie();
        $logar = new Logar();

        $config = $this->getInfo();
        
        $logar->setUrl($config['URL_API']);
        $logar->setUsuario($config['USER_API']);
        $logar->setSenha($config['PASS_API']);

        $cookie = $logar->run();
        if($cookie == 9) {
            sleep(5);
            return logar();
        }

        if($cookie === false) {
            $cc->setCookie('');
        }else{
            $cc->setCookie($cookie);        
        }
        
        $cc->save();
        return $cookie;
    }

    public function run() {

        $lock = new Lock();
        if($lock->check() == 1) {
            sleep(2);
            return run();
        }
        
        $cc     = new Cookie();
        $cookie = $cc->find();

        if(strlen($cookie) > 5) {
            $this->setCookie($cookie);
            $check = $this->check();
        }else{
            $check = false;
        }

        if($check === false) {
            $cookie = $this->logar();
        }

        return $cookie;

    }
}

