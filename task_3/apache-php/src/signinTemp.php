<?php require_once 'utilsMySql.php';
    const cookie = 'auth';

    header('Access-Control-Allow-Origin: *');

    $name = $_GET['name'];
    $password = $_GET['password'];

    if (!isset($name) || !isset($password)) {
        echo 'false';
        exit(0);
    }

    $mysqli = openConnectionToDB();
    if ($mysqli->connect_errno)
    {
        echo "Connection failed: ".$mysqli->connect_error."\n";
        exit();
    }
    //mysqli::prepare -- mysqli_prepare — Подготавливает SQL выражение к выполнению
    $statement = $mysqli->prepare(sprintf(
        'select %s from %s where name = ? and password = ?',
        'ID', 'users'
    ));
    //Привязывает переменные к подготовленному оператору в качестве параметров
    $statement->bind_param('ss', $name, $password);
    $statement->execute();
    $result = $statement->get_result()->num_rows === 1;
    $mysqli->close();

    if ($result) {
        setcookie(cookie, strval(rand(0, 9)));
        header('Location: ' . '/admin.php');
        exit(0);
    } else {
        setcookie(cookie, null);
        echo 'Wrong credentials';
    }
?>
