<div id="form-login">
    <p class="<?= Template::adicionar_feedback('alerta-estilo') ?>"><?= Template::adicionar_feedback('alert-status') ?></p>
    <form action="<?php $usuario->entrar_conta(); ?>" method="post">
        <h3><?= $label->etiqueta('titulo_fazer_login'); ?></h3>
        <div class="row">
            <div class="input-group">
                <input type="text" name="email" id="form-email" placeholder="<?= $label->etiqueta('placeholder_email'); ?>" value="<?= Template::adicionar_feedback('email-valor'); ?>">
                <p><?= Template::adicionar_feedback('email-status'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="input-group">
                <input type="password" name="senha" id="form-senha" placeholder="<?= $label->etiqueta('placeholder_senha'); ?>">
                <p><?= Template::adicionar_feedback('senha-status'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="input-group">
                <input type="submit" name="entrar-conta" value="<?= $label->etiqueta('btn_entrar_conta'); ?>">
            </div>
        </div>
        <div class="row">
            <a href="criar-conta.php"><?= $label->etiqueta('rota_criar_nova_conta'); ?></a>
        </div>
    </form>
</div>