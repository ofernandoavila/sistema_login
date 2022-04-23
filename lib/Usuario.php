<?php

class Usuario {
    public function __construct() {
        $this->errors = new Errors();
        $this->db = new Database();
    }

    public function criar_conta() {
        if(isset($_POST['criar-conta'])) {
            $this->errors->adicionarCampoObrigatorio('nome');
            $this->errors->adicionarCampoObrigatorio('email');
            $this->errors->adicionarCampoObrigatorio('senha');
            $this->errors->adicionarCampoObrigatorio('confirmar-senha');
            
            $args = array(
                'nome' => isset($_POST['nome']) ? $_POST['nome'] : '',
                'sobrenome' => isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '',
                'email' => isset($_POST['email']) ? $_POST['email'] : '',
                'senha' => isset($_POST['senha']) ? $this->ecriptar_senha($_POST['senha']) : '',
                'confirmar-senha' => isset($_POST['confirmar-senha']) ? $this->ecriptar_senha($_POST['confirmar-senha']) : ''
            );

            if(!is_string($this->validacao_criar_conta($args))) {
                var_dump(array(
                    'ecriptar_senha' => $args['senha'],
                    'chechar_se_existe_usuario_no_banco' => $this->chechar_se_existe_usuario_no_banco($args)
                ));
                die;
            } else {
                $status = $this->validacao_criar_conta($args);
                Template::redirecionar('/criar-conta.php?' . $status);
            }

            die;
            if(!$this->chechar_se_existe_usuario_no_banco($args)) {
                $status = '';
                Template::redirecionar('/criar-conta.php?' . $status);
            }
            
            if(!is_string($this->validacao_criar_conta($args))) {
                
                if($this->db->rowCount() > 0) {
                    $user = $this->db->resultSet();
                }


                Template::redirecionar('/index.php?' . Template::definir_status('alert', 'feedback_conta_criada_sucesso', true) . '&' . Template::definir_estilo('alerta', 'alerta alerta-sucesso'));
            } else {
                $status = $this->validacao_criar_conta($args);
                Template::redirecionar('/criar-conta.php?' . $status);
            }
        }
    }

    public function entrar_conta() {
        if(isset($_POST['entrar-conta'])) {
            $this->errors->adicionarCampoObrigatorio('email');
            $this->errors->adicionarCampoObrigatorio('senha');
            
            $args = array(
                'email' => isset($_POST['email']) ? $_POST['email'] : '',
                'senha' => isset($_POST['senha']) ? $this->ecriptar_senha($_POST['senha']) : ''
            );

            var_dump($this->validacao_entrar_conta($args));
            die;
            
            if(!is_string($this->validacao_entrar_conta($args))) {
                Template::redirecionar('/index.php?' . Template::definir_status('alert', 'Login realizado com sucesso!') . '&' . Template::definir_estilo('alerta', 'alerta alerta-sucesso'));
            } else {
                $status = $this->validacao_entrar_conta($args)['response'];
                Template::redirecionar('/index.php?' . $status);
            }
        }
    }

    private function validacao_criar_conta($args) {
        $status = '';
        $saida = '';

        foreach($args as $key => $field) {
            if(empty($field) && $this->errors->isCampoObrigatorio($key)) {
                $status .= Template::definir_status($key) . '&';
            } if($key != 'senha' && $key != 'confirmar-senha') $saida .= $key . '-valor=' . $field . '&';
        }

        if(empty($status) && $args['senha'] == $args['confirmar-senha']) {
            return true;
        } else {
            $response = '';
            !empty($status) ? $response .= $status . $saida : '';

            if($args['senha'] != $args['confirmar-senha']) {
                $response .= $saida . Template::definir_status('confirmar-senha', 'erro_confirmar_senha', true);
            }
            return $response;
        }
    }

    private function validacao_entrar_conta($args) {
        $status = '';
        $saida = '';

        foreach($args as $key => $field) {
            if(empty($field) && $this->errors->isCampoObrigatorio($key)) {
                $status .= Template::definir_status($key) . '&';
            } if($key != 'senha' && $key != 'confirmar-senha') $saida .= $key . '-valor=' . $field . '&';
        }

        if(empty($status) && $this->checar_autenticidade_do_usuario($args)) {
            return true;
        } else {
            $response = '';

            !empty($status) ? $response .= $status . $saida : '';
            return array(
                'response' => $response,
                'autenticado' => $this->checar_autenticidade_do_usuario($args)
            );
        }
    }

    private function ecriptar_senha($senha) {
        return hash('haval256,3', $senha);
    }

    private function checar_autenticidade_do_usuario($args) {
        $this->db->query("SELECT * FROM USUARIOS WHERE EMAIL = :email AND SENHA = :senha");
        $this->db->bind(':email', $args['email']);
        $this->db->bind(':senha', $args['senha']);
        $this->db->execute();

        return $this->db->rowCount() > 0 ? true : false;
    }

    private function autenticar_usuario($args) {
        $this->db->query("SELECT * FROM USUARIOS WHERE EMAIL = ':email' AND SENHA = ':senha'");
        $this->db->bind(':email', $args['email']);
        $this->db->bind(':senha', $args['senha']);

        return $this->db->resultSet();
    }

    private function chechar_se_existe_usuario_no_banco($args) {
        $this->db->query("SELECT * FROM USUARIOS WHERE EMAIL = :email");
        $this->db->bind(':email', $args['email']);
        $this->db->execute();

        return $this->db->rowCount() > 0 ? true : false;
    }

    private function inserir_novo_usuario_no_banco($args) {
        if(isset($args['sobrenome'])) {
            $this->db->query("INSERT INTO USUARIOS 
                                (ID, NOME, SOBRENOME, EMAIL, SENHA) VALUES 
                                (NULL, :nome, :sobrenome, :email, :senha)");
            $this->db->bind(':sobrenome', $args['sobrenome']);
            
        } else $this->db->query("INSERT INTO USUARIOS (ID, NOME, SOBRENOME, EMAIL, SENHA) VALUES (NULL, :nome, NULL, :email, :senha)");

        $this->db->bind(':nome', $args['nome']);
        $this->db->bind(':email', $args['email']);
        $this->db->bind(':senha', $args['senha']);
        
        return $this->db->execute();
    }
}