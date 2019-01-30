<?php

namespace Dins\facil;

use Dins\utils\Util;

class Lock {

    private function getEnv() {
        return parse_ini_file(".env");
    }

    public function del() {
        $config = $this->getEnv();
        $config['COOKIE_API'] = "";
        $config1 = Util::arr2ini($config);
        $fp = fopen('.env', 'w');
        fwrite($fp, $config1);
        fclose($fp);
    }

    public function lock() {
        $config = $this->getEnv();
        $config['LOCK'] = "1";
        $config1 = Util::arr2ini($config);
        $fp = fopen('.env', 'w');
        fwrite($fp, $config1);
        fclose($fp);
    }

    public function unlock() {
        $config = $this->getEnv();
        $config['LOCK'] = "0";
        $config1 = Util::arr2ini($config);
        $fp = fopen('.env', 'w');
        fwrite($fp, $config1);
        fclose($fp);
    }

    public function check() {
        $config = $this->getEnv();
        $l = $config['LOCK'];
        return $l;
    }
}
