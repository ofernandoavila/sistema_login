<?php

class Errors {
    public function __construct() {
        $this->errors = array();
    }

    public function adicionarCampoObrigatorio($field) {
        
        if(!isset($this->errors[$field])) {
            $this->errors[$field] = $field;
        } else {
            throw new Exception('Este campo já existe!');
        }
    }

    public function removerCampoObrigatorio($field) {
        if(isset($this->errors[$field])) {
            unset($this->errors[$field]);
        } else {
            throw new Exception('Este campo não foi encontrado!');
        }
    }

    public function throwErrors() {
        foreach($this->errors as $error) {
            throw new Exception('O campo ' . $error . ' não pode ser nulo!');
        }
    }

    public function verErros() {
        return $this->errors;
    }

    public function isCampoObrigatorio($campo) {
        return isset($this->errors[$campo]) ? true : false;
    }
}