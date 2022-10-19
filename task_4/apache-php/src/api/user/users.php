<?php require_once '../../utilsMySql.php';

//чтобы ответы были сразу json
header("Content-Type: application/json; charset=UTF-8");

//print_r($_SERVER);
//
// Получение данных из тела запроса
function getFormData($method)
{

    // GET или POST: данные возвращаем как есть
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;

    // PUT, PATCH или DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));

    foreach ($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}

//для взаимодействия с БД
$db = openConnectionToDB();

// Определяем метод запроса
$method = $_SERVER['REQUEST_METHOD'];
//echo $method." -method";

// Получение строки запроса
$url = $_SERVER['REQUEST_URI'];
//echo $url.' -url';

// Анализ и формирование структуры для дальнейшей обработки
$url_data = parse_url($url, PHP_URL_QUERY);
//print_r($url_data);

// Получаем данные из тела запроса
$formData = getFormData($method);

switch ($method) {
    case 'PATCH':
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        updateUser($db, $data);
        break;
    case 'GET':
        $url_data = parse_url($url, PHP_URL_QUERY);
        if (!$url_data) {
            getUsers($db);
        } else {
            $lst = explode("=", $url_data);
            getUser($db, $lst[1]);
        }
        break;
    case 'POST':
        addUser($db, $_POST);
        break;
    case 'DELETE':
        $mas = (parse_url($url, PHP_URL_PATH));
        $item = explode('/', $mas);
        $id = array_pop($item);
        deleteUser($db,$id);
        break;
    default:
        unknownMethod();
}

function addUser($db, $data)
{
    $name = $data['name'];
    $surname = $data['surname'];
    $password = $data['surname'];

    $db->query("INSERT INTO users (name, surname, password) VALUES ('$name', '$surname','$password');");
    http_response_code(201);

    $res = [
        "status" => true,
        "message" => mysqli_insert_id($db)
    ];
}

function getUsers($db)
{
    $result = $db->query("SELECT * FROM users");
    $usersList = [];
    foreach ($result as $row) {
        $usersList[] = $row;
    }
    echo json_encode($usersList);
}

function getUser($db, $id)
{
    $result = $db->query("SELECT * FROM users WHERE ID = $id");
    if (!$result->fetch_assoc()) {
        http_response_code(404);
        $res = [
            "status" => true,
            "message" => "User nor found"
        ];
        echo json_encode($res);
    } else {
        http_response_code(200);
        $usersList = [];
        foreach ($result as $row) {
            $usersList[] = $row;
        }
        echo json_encode($usersList);
    }
}

function updateUser($db, $data)
{
    $id = $data['id'];
    $name = $data['name'];
    $surname = $data['surname'];
    $password = $data['surname'];
    echo $id;
    $result = $db->query("select * from users where ID = '$id';");
    if ($result->num_rows < 1) {
        $res = [
            "status" => false,
            "message" => "user not found"
        ];
    }
    else{
        $db->query("UPDATE users 
    SET name = '$name', surname = '$surname', password = '$password' WHERE ID = '$id';");

        http_response_code(200);

        $res = [
            "status" => true,
            "message" => "user is updated"
        ];
    }
    echo json_encode($res);
}

function deleteUser($db,$id)
{
    $result = $db->query("select * from users where ID = '$id';");
    if ($result->num_rows < 1) {
        $res = [
            "status" => false,
            "message" => "user not found"
        ];
    }
    else{
        $db->query("DELETE from users 
     WHERE ID = '$id';");

        http_response_code(200);

        $res = [
            "status" => true,
            "message" => "user is deleted"
        ];
    }
    echo json_encode($res);
}

?>
