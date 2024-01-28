<?php

require_once("models/User.php");
require_once("models/Toughts.php");
require_once("models/Message.php");

class ToughtsDAO implements ToughtsDAOInterface
{

    private $conn;
    private $url;
    private $message;
    private $pagina;
    private $limitPage;
    private $inicio;
    // private float|int $registros;
    private $totalPage;

    public function __construct(PDO $conn, $url)
    {
        $this->pagina = 1;
        $this->limitPage = 10;
        // $this->inicio = ($this->pagina * $this->limitPage) - $this->limitPage;
        // $this->registros = $registros;
        // $this->totalPage = $totalPage;
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
        // $dataAtual = new DateTime();
    }
    public function showAll($pagina = 1, $order = "desc")
    {
        // $this->registros =(float) $this->countToughts();
        // $totalPage = ceil($this->registros / $this->limitPage);
        $this->pagina = $pagina ? $pagina : 1;
        // var_dump($this->pagina);
        $this->inicio = ($this->pagina * $this->limitPage) - $this->limitPage;
        // var_dump($this->inicio);
        $sql = "SELECT toug.id, toug.title, toug.createdAt, toug.updatedAt, toug.UserId, usr.id, usr.name FROM toughts AS toug
        INNER JOIN users as usr ON  toug.UserId = usr.id ORDER BY toug.id {$order} LIMIT {$this->limitPage} OFFSET {$this->inicio}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $toughts = [];
        if ($stmt->rowCount() > 0) {
            $toughtArray = $stmt->fetchAll();
            foreach ($toughtArray as $tought) {
                $toughts[] = $tought;
            }
            return $toughts;
        } else {
            return false;
        }
    }
    public function countToughts()
    {
        $sql = "SELECT COUNT(id) count FROM toughts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $count = $stmt->fetch();
    }
    public function buildTought($data)
    {
        $tought = new Toughts();
        $tought->id = $data['id'];
        $tought->title = $data['title'];
        $tought->userId = $data['UserId'];
        $tought->createdAt = $data['createdAt'];
        $tought->updatedAt = $data['updatedAt'];
        return $tought;
    }
    public function search($termo)
    {
        $sql = "SELECT toug.id, toug.title, toug.UserId, usr.id, usr.name
        FROM toughts AS toug
        INNER JOIN users AS usr ON usr.id =  toug.UserId        
        WHERE UPPER(title) LIKE UPPER(:title)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("title", strtoupper("%{$termo}%"));
        $stmt->execute();
        $toughts = [];
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $toughts[] = $row;
        }
        return $toughts;
    }
    
    public function create(Toughts $tought)
    {
        var_dump($tought);
        $sql = "INSERT INTO toughts (title, createdAt, updatedAt, UserId) VALUES (:title, NOW(), NOW(), :UserId)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam("title", $tought->title);
        $stmt->bindParam("UserId", $tought->userId);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return true;
        } else {
            return false;
        }
    }
    public function update(Toughts $tought)
    {
        $tought->id = (int) $tought->id;
        // var_dump($tought);
        // die();
        $sql = "UPDATE toughts SET title =:title, updatedAt =NOW() WHERE id=:id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":title", $tought->title);
        $stmt->bindParam(":id", $tought->id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return true;
        } else {
            return false;
        }
    }
    public function findByTought($tought)
    {
    }
    public function findById($id)
    {
        // var_dump($id);
        $sql = "SELECT toug.id, toug.title, toug.createdAt, toug.updatedAt, toug.UserId FROM toughts AS toug
        INNER JOIN users as usr ON usr.id = toug.UserId WHERE toug.UserId =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $toughts = [];
        if ($stmt->rowCount() > 0) {
            $toughtArray = $stmt->fetchAll();
            foreach ($toughtArray as $tought) {
                $toughts[] = $this->buildTought($tought);
            }
            return $toughts;
        } else {
            return false;
        }
    }
    public function findOne($id)
    {
        $id = (int) $id;
        // $sql = "SELECT * FROM toughts WHERE id=:id";
        $sql = "SELECT toug.id AS tougId, toug.title, toug.createdAt, toug.updatedAt, toug.UserId, usr.id, usr.name FROM toughts AS toug
        INNER JOIN users AS usr ON usr.id = toug.UserId WHERE toug.id =:id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $tought = $data;
            return $tought;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $id = (int) $id;
        $sql = "DELETE FROM toughts WHERE id=:id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
