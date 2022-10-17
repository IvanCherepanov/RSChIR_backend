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
}