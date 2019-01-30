<?php

namespace Dins\facil;

use Dins\utils\Curl;
use Dins\utils\Util;
use Dins\facil\Lock;

class Logar {

    private $url, $usuario, $senha, $cookie;

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }


    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setCookie($cookie) {
        $this->cookie = $cookie;
    }

    public function getCookie() {
        return $this->cookie;
    }

    private function getEnv() {
        return parse_ini_file(".env");
    }

    public function run() {
            
        $lock = new Lock();
        if($lock->check() == 1) {
            return 9;
        }else{
            $lock->lock();
        }

        if(!stristr($this->url, '.')){
            return "url invalida";
        }

        $proxy = null;

        $curl = new Curl();
        $curl->setTimeout(15);

        $post = [
            'usuario' => $this->usuario,
            'senha' => $this->senha
        ];
        $curl->add($this->url, null, http_build_query($post), $proxy);
        $res = $curl->run();

        $headers = $res['headers'][0];
        if(stristr($headers, 'cation: ./Painel')) {
            $cookies = Util::getCookies($headers);
  //          echo $cookies . PHP_EOL;
    //        echo $this->url . 'Painel' . PHP_EOL;

            $curl = new Curl();
            $curl->setTimeout(15);
            $curl->setCookie($cookies);
            $curl->add($this->url . 'Painel', $cookies, null, $proxy);
            $res1 = $curl->run();
//            echo "na 72\n";
           // print_r($res1);
            $lock->unlock();
            return $cookies;
        } else {
            $lock->unlock();
            return false;
            //print_r($res);
        }
    }

}

