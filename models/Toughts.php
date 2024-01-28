<?php

class Toughts{
    public $id;
    public $title;
    public $userId;
    public $createdAt;
    public $updatedAt;

}

interface ToughtsDAOInterface{
    public function buildTought($data);
    public function create(Toughts $tought);
    public function update(Toughts $tought);
    public function findByTought($tought);
    public function showAll();
    public function findById($id);
    public function findOne($id);
    public function delete($id);
}