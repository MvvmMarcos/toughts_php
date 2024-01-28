<?php
require_once('templates/header.php');
require_once('globals.php');
?>
    <section id="register">
        <h1 class="title">Cadastrar usuário</h1>
        <form action="<?=$URL?>user_process.php" method="POST">
        <input type="hidden" name="type" value="register">
            <div class="form-control">
                <label for="name">Nome:</label>
                <input type="text" name="name" placeholder="Digite seu nome">
            </div>
            <div class="form-control">
                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-control">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha">
                <p id="message">A senha é <span id="forca"></span></p>
            </div>
            <div class="form-control">
                <label for="confirmarSenha">Confirme a senha:</label>
                <input type="password" name="confirmarSenha" id="confirmarSenha"" placeholder="Confirme a sua senha">
            </div>
            <button type="submit" class="btn-form">Cadastrar</button>
            <p class="info">Já tem uma conta? <a href="<?=$URL?>login.php">Clique aqui</a> e faça o login</p>
        </form>
    </section>

    <?php
require_once('templates/footer.php')
?>