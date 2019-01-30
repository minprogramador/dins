<?php

namespace Dins\facil;

use Dins\Login;

class Logar {

    private $usuario, $senha, $cookie;

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public funtion getUsuario() {
        return $this->usuario;
    }


    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public funtion getSenha() {
        return $this->senha;
    }

    public function setCookie($cookie) {
        $this->cookie = $cookie;
    }

    public funtion getCookie() {
        return $this->cookie;
    }

    public function logar() {

    }

}
