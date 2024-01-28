<?php
require_once('./globals.php');
require_once('./conexao.php');
require_once('./models/Message.php');
require_once('./dao/UserDAO.php');
$userDao = new UserDAO($conn, $URL);
$message = new Message($URL);
// var_dump($_SESSION);
//pegar a mensagem
$flashMessage = $message->getMessage();
//limpar a mensagem
if(!empty($flashMessage['msg'])){
    $message->clearMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toughts</title>
    <link rel="stylesheet" href="<?=$URL?>assets/css/style.css">
    <link rel="shortcut icon" href="<?=$URL?>img/favicon.png" type="image/x-icon">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="<?=$URL?>"><img src="img/logo2.png" alt="logo" class="logo"></a>
                <ul>
                    <li><a href="<?=$URL?>">Home</a></li>
                    <li><a href="<?=$URL?>tought">Pensamentos</a></li>
                    <?php if($_SESSION['user_id'] != ""):?>
                    <li><a href="<?=$URL?>createToughts.php">Postar Pensamento</a></li>
                    <li><a href="<?=$URL?>dashboard.php">Dashboard</a></li>
                    <li><a href="<?=$URL?>logout.php">Sair</a></li>
                    <?php else: ?>
                    <li><a href="<?=$URL?>register.php">Cadastrar</a></li>
                    <li><a href="<?=$URL?>login.php">Entrar</a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>

    </header>
     <?php if(!empty($flashMessage['msg'])):?>
        <div class="msg-container">
            <p class="<?=$flashMessage['type']?>"><?=$flashMessage['msg']?></p>;
        </div>
        
       <?php endif;?> 