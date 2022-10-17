<?php require_once '../../utilsMySql.php';

//чтобы ответы были сразу json
#header("Content-Type: application/json; charset=UTF-8");

//print_r($_SERVER);
//
// Получение данных из тела запроса
function getFormData($method) {

    // GET или POST: данные возвращаем как есть
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;

    // PUT, PATCH или DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));

    foreach($exploded as $pair) {
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
//echo "\n";
//echo $url.' -url';
// Анализ и формирование структуры для дальнейшей обработки
//parse_url($url, PHP_URL_PATH);
//echo $url_data.' -url_data';
$url_data = parse_url($url,PHP_URL_QUERY);
//print_r($url_data);
//echo "\n";
// Получаем данные из тела запроса
$formData = getFormData($method);
//print_r($formData);
//echo "\n";

switch ($method) {
    case 'PUT':
        break;
    case 'GET':
        //
        $url_data = parse_url($url,PHP_URL_QUERY);
        //print_r($url_data);
        if (!$url_data){
            getUsers($db);
        }else {
            $lst = explode("=", $url_data);
            //print_r($lst[1]);
            //print_r("eeeee");
            getUser($db, $lst[1]);
        }
        break;
    case 'POST':
        addUser($db, $formData);
        //updateUser($url_data);
        break;
    case 'DELETE':
        //deleteUser($url_data);
        break;
    default:
        unknownMethod();
}

function createUser($data)
{
    global $db;
    $successCreated = $db->createUser($db, $data);
    if (isset($successCreated)) {
        header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
        echo json_encode(array(
            'name' => $data['name'],
            'surname' => $data['surname'],
            'id' => $successCreated['id']));
    } else {
        header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
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
        //echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
    }
    echo json_encode($usersList);
    //$users = mysqli_query($db, "SELECT * FROM 'users'");
    //echo json_encode($users);
    //print_r($users);
    //$usersList = [];
    //while ($user = mysqli_fetch_assoc($users)) {
    //    $usersList[] = $user;
    //}
    //echo json_encode($usersList);
}

function getUser($db, $id)
{
    $result = $db->query("SELECT * FROM users WHERE ID = $id");
    //print_r($result->fetch_assoc());
    //print_r("SELECT * FROM users WHERE ID = $id");
    //print_r($result);
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
            //echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
        }
        echo json_encode($usersList);
    }
}

?>
