<?php
namespace mvc_app\models;

use mvc_app\core\Model;

class Product extends Model
{
    function getProducts()
    {
        return $this->db->query("SELECT * FROM products");
    }
    function getProduct($id)
    {
        return $this->db->query("SELECT * FROM products WHERE ID = '$id';");
    }

    function create($user)
    {
        if (
            !empty($user->description) &&
            !empty($user->price)
        ) {
        $description = htmlspecialchars(strip_tags($user->description));
        $price = htmlspecialchars(strip_tags($user->price));

        $this->db->query("INSERT INTO products (description, price) VALUES ('$description', '$price');");
        return array("result" => json_encode("Товар был создан.", JSON_UNESCAPED_UNICODE), "code" => 201);
    }
    else {
        return array("result" => json_encode("Невозможно создать товар", JSON_UNESCAPED_UNICODE), "code" => 503);
    }
    }

    public function read(){
        $result = $this->db->query("SELECT * FROM products;");
        $usersList = [];
        foreach ($result as $row) {
            $usersList[] = $row;
        }
        #debug($usersList);
        #debug($this->db->query("SELECT * FROM users;"));
        if (!empty($result)) {
            return array("result"=> json_encode($usersList, JSON_UNESCAPED_UNICODE), "code" => 200);
        }
        else {
            return array("result"=> json_encode("Товар не найден.", JSON_UNESCAPED_UNICODE), "code" => 404);
        }
    }
    public function readOne($id){
        $result = $this->db->query("SELECT * FROM products WHERE ID = '$id';");
        $usersList = [];
        foreach ($result as $row) {
            $usersList[] = $row;
        }
        #debug($usersList);
        #debug($this->db->query("SELECT * FROM users;"));
        if (!empty($result)) {
            return array("result"=> json_encode($usersList, JSON_UNESCAPED_UNICODE), "code" => 200);
        }
        else {
            return array("result"=> json_encode("Товар не найден.", JSON_UNESCAPED_UNICODE), "code" => 404);
        }
    }

    public function update($user){
        $description = htmlspecialchars(strip_tags($user->description));
        $price = htmlspecialchars(strip_tags($user->price));
        $id = htmlspecialchars(strip_tags($user->id));
        $this->db->query("UPDATE products  
            SET description = '$description', 
                price = '$price'
            WHERE ID = '$id';");
        if (!empty($description) && !empty($price)) {
            return array("result"=> json_encode(
                "Товар был обновлён",
                JSON_UNESCAPED_UNICODE),
                "code" => 200);
        }
        else {
            return array("result"=> json_encode(
                "Невозможно обновить товар",
                JSON_UNESCAPED_UNICODE),
                "code" => 503);
        }
    }

    public function delete($data){
        #echo $data;
        $id = htmlspecialchars(strip_tags($data->id));
        #echo $id;
        $result = $this->db->query("select * from products where ID = '$id';");
        if ($result->num_rows < 1) {
            return array("result"=> json_encode(
                "Товар не найден",
                JSON_UNESCAPED_UNICODE),
                "code" => 404);
        }
        else{
            $this->db->query("DELETE from products 
                WHERE ID = '$id';");
            return array(
                "result"=> json_encode(
                    "Товар был удален",
                    JSON_UNESCAPED_UNICODE),
                "code" => 200);
        }
    }
}