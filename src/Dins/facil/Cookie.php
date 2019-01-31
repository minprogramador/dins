<?php

namespace Dins\facil;

use Dins\utils\Util;

class Cookie {

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

    private function getEnv() {
        return parse_ini_file("../.env");
    }

    public function del() {
        $config = $this->getEnv();
        $config['COOKIE_API'] = "";
        $config1 = Util::arr2ini($config);
        $fp = fopen('../.env', 'w');
        fwrite($fp, $config1);
        fclose($fp);
    }

    public function save() {
        $config = $this->getEnv();
        $config['COOKIE_API'] = $this->cookie;
        $config1 = Util::arr2ini($config);
        $fp = fopen('../.env', 'w');
        fwrite($fp, $config1);
        fclose($fp);
    }

    public function find() {
        $config = $this->getEnv();
        $cookie = $config['COOKIE_API'];
        return $cookie;
    }
}
