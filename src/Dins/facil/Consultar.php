<?php

namespace Dins\facil;

use Dins\utils\Curl;
use Dins\utils\Util;
use Dins\facil\Cookie;

class Consultar {

    private $nb, $url, $cookie;


    public function setNb($nb) {
        $this->nb = $nb;
    }

    public function getNb() {
        return $this->nb;
    }


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
        $nb = $this->nb;
        
        if(!stristr($this->url, '.')){
            return "url invalida";
        }

        $proxy = null;
        $post = "enviarnb={$nb}&pesquisar=CONSULTAR";
        $curl = new Curl();
        $curl->setTimeout(20);
        $curl->add($this->url, $this->cookie, $post, $proxy);
        $res = $curl->run();

        $headers = $res['headers'][0];

        if(stristr($headers, 'ocation: ./Sair')) {

            return false;

        } else {

            $body = $res['body'][0];
            if(stristr($body, 'ERRO DE COMUNI')){

                return 5;

            }elseif(stristr($headers, 'filename="ExtratoConsignacoes')) {

                $fp = fopen(".cache/".$nb . '_'. time() .".pdf", "w");
                $escreve = fwrite($fp, $body);
                fclose($fp);
                return $body;

            }else{
                return 8;
                // echo PHP_EOL . $post . PHP_EOL;
                // echo $this->url . PHP_EOL;
                // echo $this->cookie . PHP_EOL;
                // print_r($res);
                // die;
            }

        }
    }


}


















