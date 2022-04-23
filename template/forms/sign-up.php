<div id="form-cadastro">
    <form action="<?php $usuario->criar_conta(); ?>" method="post">
        <h3><?= $label->etiqueta('titulo_criar_conta'); ?></h3>
        <div class="row">
            <div class="input-group">
                <input type="text" name="nome" id="form-nome" placeholder="<?= $label->etiqueta('placeholder_nome'); ?>" value="<?= Template::adicionar_feedback('nome-valor'); ?>">
                <p><?= Template::adicionar_feedback('nome-status'); ?></p>
            </div>
            <div class="input-group">
                <input type="text" name="sobrenome" id="form-sobrenome" placeholder="<?= $label->etiqueta('placeholder_sobrenome'); ?>" value="<?= Template::adicionar_feedback('sobrenome-valor'); ?>">
                <p><?= Template::adicionar_feedback('sobrenome-status'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="input-group">
                <input type="email" name="email" id="form-email" placeholder="<?= $label->etiqueta('placeholder_email'); ?>" value="<?= Template::adicionar_feedback('email-valor'); ?>">
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
                <input type="password" name="confirmar-senha" id="form-confirmar-senha" placeholder="<?= $label->etiqueta('placeholder_confirmar_senha'); ?>">
                <p><?= Template::adicionar_feedback('confirmar-senha-status'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="input-group">
                <input type="submit" value="<?= $label->etiqueta('btn_criar_nova_conta'); ?>" name="criar-conta">
            </div>
        </div>
        <div class="row">
            <a href="index.php"><?= $label->etiqueta('rota_ja_possui_conta'); ?></a>
        </div>
    </form>
</div>