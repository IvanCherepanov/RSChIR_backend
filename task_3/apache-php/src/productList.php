<html lang="en">
<head>
<title>Hello world page</title>
</head>
<style>
    /* внешние границы таблицы серого цвета толщиной 1px */
    table {
        border: 1px solid grey;
        margin-left: auto;
        margin-right: auto;
    }
    /* границы ячеек первого ряда таблицы */
    th {
        border: 1px solid grey;
        font-size: 250%;
    }
    /* границы ячеек тела таблицы */
    td {
        border: 1px solid grey;
        font-size: 250%;
    }
    h1 {
        text-align: center;
    }
</style>
<body>
<h1>Таблица меню</h1>
<table>
    <tr>
        <th>Description</th>
        <th>Price</th>
    </tr>
<?php require_once 'utilsMySql.php';
    $mysqli = openConnectionToDB();
    $result = $mysqli->query("SELECT * FROM products");
    $id = 'id';
    foreach ($result as $row){
        echo "
    <tr>
        <td><a href='/itemShow.php?id={$row['ID']}'>{$row['description']}</a></td>
        <td>{$row['price']}</td>
    </tr>
    ";
    }
$mysqli->close();
?>
</table>
<?php
phpinfo();
?>
</body>
</html>