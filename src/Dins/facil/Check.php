<?php

namespace Dins\facil;

use Dins\utils\Curl;
use Dins\utils\Util;
use Dins\facil\Cookie;

class Check {

    private $url, $cookie;

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
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
        $curl->add($this->url, $this->cookie, null, $proxy);
        $res = $curl->run();

        $headers = $res['headers'][0];

        if(stristr($headers, 'ocation: ./Sair')) {
            $ur = str_replace('Painel', 'Sair', $this->url);
            $cookies = Util::getCookies($headers);

            $curl = new Curl();
            $curl->setTimeout(10);
            $curl->add($ur, $cookies, null, $proxy);
            $res1 = $curl->run();

            return false;
        } else {
            $body = $res['body'][0];
            if(stristr($body, '>Consultas Limit')) {
                return true;
            }else{
                echo "\n\nna 54\n\n\n";
                print_r($res);
                die;
                return false;
            }

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
















