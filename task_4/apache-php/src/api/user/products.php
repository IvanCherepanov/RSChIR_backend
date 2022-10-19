<?php require_once '../../utilsMySql.php';

//чтобы ответы были сразу json
header("Content-Type: application/json; charset=UTF-8");

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

switch ($method) {
    case 'PATCH':
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        updateProduct($db, $data);
        break;
    case 'GET':
        $url_data = parse_url($url, PHP_URL_QUERY);
        if (!$url_data) {
            getProducts($db);
        } else {
            $lst = explode("=", $url_data);
            getProduct($db, $lst[1]);
        }
        break;
    case 'POST':
        addProduct($db, $_POST);
        break;
    case 'DELETE':
        $mas = (parse_url($url, PHP_URL_PATH));
        $item = explode('/', $mas);
        $id = array_pop($item);
        deleteProduct($db, $id);
        break;
    default:
        unknownMethod();
}

function addProduct($db, $data)
{
    $description = $data['description'];
    $price = $data['price'];


    if ($db->query("INSERT INTO 
                    products (description, price) 
                    VALUES ('$description', '$price');")) {
        http_response_code(201);

        $res = [
            "status" => true,
            "message" => mysqli_insert_id($db)
        ];
    }
    else{
        http_response_code(503);
        $res = [
            "status" => false,
            "message" => "Невозможно создать товар."
        ];
    }
    echo json_encode($res);
}

function getProducts($db)
{
    $result = $db->query("SELECT * FROM products");
    $productsList = [];
    foreach ($result as $row) {
        $productsList[] = $row;
    }
    echo json_encode($productsList);
}

function getProduct($db, $id)
{
    $result = $db->query("SELECT * FROM products WHERE ID = $id");
    if (!$result->fetch_assoc()) {
        http_response_code(404);
        $res = [
            "status" => true,
            "message" => "Product not found"
        ];
        echo json_encode($res);
    } else {
        http_response_code(200);
        $productsList = [];
        foreach ($result as $row) {
            $productsList[] = $row;
        }
        echo json_encode($productsList);
    }
}

function updateProduct($db, $data)
{
    $id = $data['id'];
    $description = $data['description'];
    $price = $data['price'];

    $result = $db->query("select * from products where ID = '$id';");
    if ($result->num_rows < 1) {
        $res = [
            "status" => false,
            "message" => "user not found"
        ];
    } else {
        $db->query("UPDATE products 
    SET description = '$description', price = '$price' WHERE ID = '$id';");

        http_response_code(200);

        $res = [
            "status" => true,
            "message" => "Product is updated"
        ];
    }
    echo json_encode($res);
}

function deleteProduct($db, $id)
{
    $result = $db->query("select * from products where ID = '$id';");
    if ($result->num_rows < 1) {
        $res = [
            "status" => false,
            "message" => "Product not found"
        ];
    } else {
        $db->query("DELETE from products 
     WHERE ID = '$id';");

        http_response_code(200);

        $res = [
            "status" => true,
            "message" => "Product is deleted"
        ];
    }
    echo json_encode($res);
}

?>
