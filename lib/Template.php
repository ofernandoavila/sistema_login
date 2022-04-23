<?php

class Template {
    public static function adicionar_feedback($campo) {
        return isset($_GET[$campo]) ? $_GET[$campo] : '';
    }

    public static function redirecionar($path) {
        header('location: http://localhost/sistema_login' . $path);
    }

    public static function definir_status($campo, $mensagem = '', $etiqueta = false) {
        $label = new Label(APP_IDIOMA);
        
        if($etiqueta) {
            $mensagem = $label->etiqueta($mensagem);
        } else empty($mensagem) ? $mensagem = $label->etiqueta('erro_campo_obrigatorio_vazio') : $mensagem;
        
        return $campo . '-status' . '=' . $mensagem;
    }

    public static function definir_estilo($modulo, $estilo) {
        return $modulo . '-estilo=' . $estilo;
    }
}