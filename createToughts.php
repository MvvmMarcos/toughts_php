<?php
require_once('templates/header.php');
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("conexao.php");
require_once('function/verifyLogin.php');
//verificar login
$verify = VerifyLogin::verifyLogin();
//verificar se o usuario esta logado
$userDao = new UserDAO($conn, $URL);
$user = $userDao->findById($_SESSION['user_id']);
// var_dump($user);
// var_dump($_SESSION['user_id']);
?>
    <section id="createTought">
        <div class="create-container">
            <h1>Criar pensamento</h1>
            <form action="<?=$URL?>toughts_process.php" method="POST">
            <input type="hidden" name="type" value="create">
            <input type="hidden" name="id" value="<?=$user->id?>">
                <div class="form-control">
                    <label for="title">Pensamento</label>
                    <input type="text" name="title" placeholder="Digite seu pensamento">
                </div>
                <button type="submit" class="btn-form">Criar</button>
           </form>
        </div>
    </section>


<?php
require_once('templates/footer.php')
?>
