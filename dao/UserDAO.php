<?php

require_once("models/User.php");
require_once("models/Message.php");

class UserDAO implements UserDAOInterface{
    
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }
    public function buildUser($data){
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        return $user;
    }
    public function create(User $user){
        $sql = "INSERT INTO users (name, email, password, createdAt, updatedAt) VALUES (:name, :email, :password, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function update(User $user){
        
    }
    public function authenticateUser($email, $password){
        $user = $this->findByEmail($email);
        //checar a senha
        if(password_verify($password, $user->password)){
            $this->setSession($user);
            return true;
        }else{
            return false;
        }
    }
    public function findByEmail($email){
        $sql = "SELECT * FROM users WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
        }else{
            return false;
        }
    }
    public function findById($id){
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
        }else{
            return false;
        }
    }
    public function setSession(User $user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
    }
    public function logout(){
        $_SESSION['user_id'] = "";
        $_SESSION['user_name'] = "";
        $_SESSION['user_email'] = "";
        $this->message->setMessage('Logout realizado com sucesso!','success','login.php');;
    }
}