<?php
require_once("templates/header.php");
// var_dump($_SESSION);
?>
    <section id="login">
        <h1 class="title">Cadastrar usuário</h1>
        <form action="<?=$URL?>user_process" method="POST">
        <input type="hidden" name="type" value="login">
            <div class="form-control">
                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-control">
                <label for="password">Senha:</label>
                <input type="password" name="password" placeholder="Digite sua senha">
            </div>
            <button type="submit" class="btn-form">Entrar</button>
            <p class="info">Não tem uma conta? <a href="<?=$URL?>create.php">Clique aqui</a> e cadastre-se!</p>
        </form>
    </section>
    
    <?php
require_once("templates/footer.php")
?>