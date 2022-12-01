<?php
namespace mvc_app\models;

use mvc_app\core\Model;

class Admin extends Model
{
    function getUsers()
    {
        return $this->db->query("SELECT * FROM users");
    }

    function create($user)
    {
        if (
            !empty($user->name) &&
            !empty($user->surname) &&
            !empty($user->password)
        ) {
        $name = htmlspecialchars(strip_tags($user->name));
        $surname = htmlspecialchars(strip_tags($user->surname));
        $password = htmlspecialchars(strip_tags($user->password));

        $this->db->query("INSERT INTO users (name, surname, password) VALUES ('$name', '$surname','$password');");
        return array("result" => json_encode("Пользователь был создан.", JSON_UNESCAPED_UNICODE), "code" => 201);
    }
    else {
        return array("result" => json_encode("Невозможно создать пользователя", JSON_UNESCAPED_UNICODE), "code" => 503);
    }
    }

    public function read(){
        $result = $this->db->query("SELECT * FROM users;");
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
            return array("result"=> json_encode("Пользователь не найден.", JSON_UNESCAPED_UNICODE), "code" => 404);
        }
    }

    public function update($user){
        $name = htmlspecialchars(strip_tags($user->name));
        $surname = htmlspecialchars(strip_tags($user->surname));
        $password = htmlspecialchars(strip_tags($user->password));
        $id = htmlspecialchars(strip_tags($user->id));
        $this->db->query("UPDATE users  
            SET name = '$name', 
                surname = '$surname', 
                password = '$password' 
            WHERE ID = '$id';");
        if (!empty($name) && !empty($password) && !empty($id)) {
            return array("result"=> json_encode(
                "Пользователь был обновлён",
                JSON_UNESCAPED_UNICODE),
                "code" => 200);
        }
        else {
            return array("result"=> json_encode(
                "Невозможно обновить пользователя",
                JSON_UNESCAPED_UNICODE),
                "code" => 503);
        }
    }

    public function delete($data){
        #echo $data;
        $id = htmlspecialchars(strip_tags($data->id));
        #echo $id;
        $result = $this->db->query("select * from users where ID = '$id';");
        if ($result->num_rows < 1) {
            return array("result"=> json_encode(
                "Пользователь не найден",
                JSON_UNESCAPED_UNICODE),
                "code" => 404);
        }
        else{
            $this->db->query("DELETE from users 
                WHERE ID = '$id';");
            return array(
                "result"=> json_encode(
                    "Пользователь был удален",
                    JSON_UNESCAPED_UNICODE),
                "code" => 200);
        }
    }
}