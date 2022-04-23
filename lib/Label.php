<?php

class Label {
    public function __construct($idioma) {
        $this->label = $this->carregar_idioma(APP_IDIOMA);
    }

    private function carregar_idioma($idioma) {
        return include('./labels/' . $idioma . '.php');
    }

    public function etiqueta($label) {
        return $this->label[$label];
    }
}

