<?php


namespace mvc_app\lib;

use mysqli;
//todo: если не получится, вернуть как было: через mysqli
class Db
{

    protected $db;

    public function __construct()
    {
        $config = require 'mvc_app/config/db.php';
        $host = $config['host'];
        $db = $config['dbname'];
        $user = $config['username'];
        $password = $config['password'];
        $this->db = new mysqli($host,$user,$password,$db);
        #$this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . '', $config['username'], $config['password']);
    }

    public function query($sql, $params = [])
    {
        return $this->db->query($sql);
    }

//    public function query($sql, $params = [])
//    {
//        $stmt = $this->db->prepare($sql);
//        if (!empty($params)) {
//            foreach ($params as $key => $val) {
//                $stmt->bindValue(':' . $key, $val);
//            }
//        }
//        $stmt->execute();
//        return $stmt;
//    }

//    public function row($sql, $params = [])
//    {
//        $result = $this->query($sql, $params);
//        return $result->fetchAll(PDO::FETCH_ASSOC);
//    }

//    public function column($sql, $params = [])
//    {
//        $result = $this->query($sql, $params);
//        return $result->fetchColumn();
//    }


}