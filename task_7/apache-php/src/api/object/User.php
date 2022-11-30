<?php

class User
{
    // подключение к базе данных и таблице "products"
    private $conn;
    private $table_name = "users";

    // свойства объекта
    public $id;
    public $name;
    public $surname;
    public $password;

    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод для получения пользователей
    function read()
    {
        // выбираем все записи
        $query = "SELECT
        *
    FROM
        " . $this->table_name . " 
        ";
        //echo $query;
        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();
        return $stmt;
    }

    function create(){

        $stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(name, surname, password)
			VALUES(?,?,?,?)");

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bind_param("ssii", $this->name, $this->description, $this->price, $this->category_id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
}