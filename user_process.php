<?php
require_once('conexao.php');
require_once('globals.php');
require_once('models/User.php');//vai que precise
require_once('dao/UserDAO.php');
require_once('models/Message.php');

$user = new User();
$userDao = new UserDAO($conn, $URL);
$message = new Message($URL);

//receber o tipo de formulário
$type = filter_input(INPUT_POST,'type');
// var_dump($type);
//verificar o tipo de formulário
if($type === "register"){
    //receber os dados do formulário
    $name = strip_tags(filter_input(INPUT_POST,'name'));
    $email = strip_tags(filter_input(INPUT_POST,'email'));
    $password = strip_tags(filter_input(INPUT_POST,'password'));
    $confirmarSenha = strip_tags(filter_input(INPUT_POST,'confirmarSenha'));
    if(empty($name)){
        $message->setMessage('Necessário preencher o campo nome!','danger','back');
    }else if(empty($email)){
        $message->setMessage('Necessário preencher o campo e-mail!','danger','back'); 
    }else if(empty($password)){
        $message->setMessage('Necessário preencher o campo senha!','danger','back'); 
    }else if(empty($confirmarSenha)){
        $message->setMessage('Necessário preencher o campo confirmar senha!','danger','back'); 
    }else{
        if($confirmarSenha != $password){
            $message->setMessage('As senha precisam ser iguais!','danger','back');
        }else if($userDao->findByEmail($email)){
            $message->setMessage('E-mail já cadastrado!','danger','back');
        }else{
            $user = new User();
            $finalPassword = $user->generatePassword($password);
            $user->name = $name;
            $user->email = $email;
            $user->password = $finalPassword;
            if($userDao->create($user)){
                $message->setMessage('Usuário cadastrado com sucesso!','success','login.php');
                //depois mandar para a dashboard
            }
        }        
    }
}else if($type==="login"){
    //receber os dados do formulário
    $email = strip_tags(filter_input(INPUT_POST,'email'));
    $password = strip_tags(filter_input(INPUT_POST,'password'));
    //autenticar o usuario 
    if($userDao->authenticateUser($email, $password)){
        $message->setMessage("Seja bem vindo(a)!","success");//depois redirecionar para dashboard
    }else{
        $message->setMessage('Usuário ou senha incorretas!','danger','back');
    }
}else{
    $message->setMessage('Informações inválidas!','danger','back');
}