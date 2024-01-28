<?php
require_once('conexao.php');
require_once('globals.php');
require_once('models/User.php');//vai que precise
require_once('dao/UserDAO.php');
require_once('dao/ToughtsDAO.php');
require_once('models/Message.php');

$user = new User();

$userDao = new UserDAO($conn, $URL);



$toughtDao = new ToughtsDAO($conn, $URL);

$message = new Message($URL);

//receber o tipo de formulário
$type = strip_tags(filter_input(INPUT_POST,'type'));
//verificar o tipo de formulário
if($type === "edit"){
    $id = strip_tags(filter_input(INPUT_POST,'id'));
    $title = strip_tags(filter_input(INPUT_POST,'title'));
    $userId = strip_tags(filter_input(INPUT_POST,'userId'));
    $createdAt = strip_tags(filter_input(INPUT_POST,'createdAt'));
    $updatedAt = strip_tags(filter_input(INPUT_POST,'updatedAt'));
    // var_dump($id, $title,$userId,$createdAt,$updatedAt);
    // die();
    $tought = new Toughts();
    $tought->id = (int) $id;
    $tought->title = $title;
    $tought->userId = (int) $userId;
    $tought->createdAt = $createdAt;
    $tought->updatedAt = $updatedAt;

    if($toughtDao->update($tought)){
        $message->setMessage('Pensamento atualizado com sucesso!','success','dashboard.php');
    }else{
        $message->setMessage('Pensamento não atualizado, por favor tente novamente!','danger','back');
    }
 }else if($type === "create"){
    $id = (int) strip_tags(filter_input(INPUT_POST,'id'));
    $title = strip_tags(filter_input(INPUT_POST,'title'));
    if($title === ""){
        $message->setMessage('Precisa preencher o campo pensamento!','danger','back');
    }
    // var_dump($id);
    // var_dump($title);
    $tought = new Toughts();
    $tought->id = $id;
    $tought->title = $title;
    $tought->userId = $id;
    if($toughtDao->create($tought)){
        $message->setMessage('Pensamento criado com sucesso!','success','dashboard.php');
    }else{
        $message->setMessage('Pensamento não criado, por favor tente novamente!','danger','back');
    }
}
else if($type === "order"){
    $order = strip_tags(filter_input(INPUT_POST,'order', FILTER_DEFAULT));
    $pagina =(int) strip_tags(filter_input(INPUT_POST,'pagina',FILTER_DEFAULT));
    // var_dump($order);
    // die;
    if($order === "old"){
        $toughtDao->showAll($pagina,"asc");
        header("Location: ".$URL."tought.php?page={$pagina}&order=asc");
    }elseif($order === "new"){
        $toughtDao->showAll($pagina, $order="desc");
        header("Location: ".$URL."tought.php?page={$pagina}&order=desc");
    }
}
else if($type === "delete"){
    $id = filter_input(INPUT_POST,"id");
    $metodo = filter_input(INPUT_SERVER,'REQUEST_METHOD', FILTER_DEFAULT);
    var_dump($metodo);
    var_dump($id);
    if($id && $metodo === "POST"){
        if($toughtDao->delete($id)){
            $message->setMessage('Pensamento deletado com sucesso!','success','dashboard.php');
        }else{
            $message->setMessage('Pensamento não foi deletado!','danger','back');
        }
    }else{
        $message->setMessage('Informações inválidas!','danger');
    }
}
