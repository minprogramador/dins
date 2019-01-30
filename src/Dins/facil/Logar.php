<?php

namespace Dins\facil;

use Dins\utils\Curl;
use Dins\utils\Util;

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

    public function run() {
        
        if(!stristr($this->url, '.')){
            return "url invalida";
        }

        $proxy = null;

        $curl = new Curl();
        $curl->setTimeout(10);

        $post = [
            'usuario' => $this->usuario,
            'senha' => $this->senha
        ];

        $curl->add($this->url, null, http_build_query($post), $proxy);
        $res = $curl->run();
        $headers = $res['headers'][0];
        if(stristr($headers, 'cation: ./Painel')) {
            return Util::getCookies($headers);
        } else {

            print_r($res);

        }
    }

}



        // $config = parse_ini_file(".env");

        // if($urlpath) { $config['url_path'] = $urlpath; }
        // if($api_cpf) { $config['api_cpf'] = $api_cpf; }
        // if($proxy) { $config['proxy'] = $proxy; }
        // if($debug) { $config['debug'] = $debug; }
        // if($ip_debug) { $config['ip_debug'] = $ip_debug; }
        // if($status)  { $config['status'] = $status; }
        // if($timeout) { $config['timeout'] = $timeout; }

        // $config = arr2ini($config);

        // $fp = fopen('.env', 'w');
        // fwrite($fp, $config);
        // fclose($fp);
















