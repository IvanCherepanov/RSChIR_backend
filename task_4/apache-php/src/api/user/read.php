<?php require_once '../../utilsMySql.php';

    $db = openConnectionToDB();

    // создание объекта товара
    include_once "../object/User.php";

    // инициализируем объект
    $user = new User($db);

    // запрашиваем товары
    $stmt = $user->read();
    //$num = $stmt->num_rows;

    // проверка, найдено ли больше 0 записей
    if ($stmt) {
        // массив товаров
        $user_arr = array();
        $user_arr["records"] = array();

        // получаем содержимое нашей таблицы
        // fetch() быстрее, чем fetchAll()
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            // извлекаем строку
            extract($row);
            //echo  $row;
            $user_item = array(
                "id" => $ID,
                "name" => $name,
                "surname" => $surname,
                "password" => $password
            );
            array_push($user_arr["records"], $user_item);
        }

        // устанавливаем код ответа - 200 OK
        http_response_code(200);

        // выводим данные о товаре в формате JSON
        echo json_encode($user_arr);
    }
    else {
        // установим код ответа - 404 Не найдено
        http_response_code(404);

        // сообщаем пользователю, что товары не найдены
        echo json_encode(array("message" => "Пользователи не найдены."), JSON_UNESCAPED_UNICODE);
    }

