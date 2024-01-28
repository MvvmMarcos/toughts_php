<?php

class User{
    public $id;
    public $name;
    public $email;
    public $password;

    public function generatePassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

interface UserDAOInterface{
    public function buildUser($data);
    public function create(User $user);
    public function update(User $user);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function setSession(User $user);
    public function logout();
}