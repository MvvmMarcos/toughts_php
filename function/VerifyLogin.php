<?php
require_once('models/Message.php');
// require_once('../globals.php');

class VerifyLogin{
    public $message;

    public static function verifyLogin(){
        require_once('./globals.php');
        if(!$_SESSION['user_id'] && !$_SESSION['user_name']  && !$_SESSION['user_email']){
            $message = new Message($URL);
            $message->setMessage('Para realizar qualquer operação primeiro realize o login','danger');
        }
    }
}