<?php
require_once('templates/header.php');
require_once("dao/ToughtsDAO.php");
require_once("globals.php");
require_once("conexao.php");
require_once('function/FormatData.php');
require_once('function/verifyLogin.php');
//verificar login
$verify = VerifyLogin::verifyLogin();
//verificar se o usuario esta logado
$toughtDao = new ToughtsDAO($conn, $URL);
//pegar o id vindo pela url
$id = (int) strip_tags(filter_var($_GET['id']));
// var_dump($id);
//trazer o pensamento do usuário
$tought = $toughtDao->findOne($id);
// var_dump($tought);
?>
    <section id="editTought">
        <div class="edit-container">
            <h1>Pensamento criado por: <span> <?=$tought['name']?></span></h1>
            <form action="<?=$URL?>toughts_process.php" method="POST">
                <input type="hidden" name="type" value="edit">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="hidden" name="userId" value="<?=$tought['UserId']?>">
                <input type="hidden" name="createdAt" value="<?=$tought['createdAt']?>">
                <input type="hidden" name="updatedAt" value="<?=$tought['updatedAt']?>">
                <div class="form-control">
                    <label for="title">Pensamento</label>
                    <input type="text" name="title" value="<?=$tought['title']?>">
                </div>
                <button type="submit" class="btn-form">Atualizar</button>
           </form>
        </div>
    </section>


<?php
require_once('templates/footer.php')
?>
