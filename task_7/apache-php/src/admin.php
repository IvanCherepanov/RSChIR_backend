<?php
    require_once 'utilsMySql.php';
?>

<?php
$themeStyleSheet = 'http://localhost:8006/main.css';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $themeStyleSheet = 'http://localhost:8006/dark.css';
}
$favicon = "http://localhost:8006/img/hp.jpg";
if (!empty($_COOKIE['fav']) && $_COOKIE['fav'] == 'witcher') {
    $favicon = "http://localhost:8006/img/witch.jpg";
}
?>

<html lang="en">
<head>
    <title>Hello world page</title>
    <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon" id="fav-link">
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
<h1>Таблица пользователей данного продукта</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Surname</th>
    </tr>
    <?php
    $mysqli = openConnectionToDB();
    $result = $mysqli->query("SELECT * FROM users");
    foreach ($result as $row) {
        echo "<tr><td>{$row['ID']}</td><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
    }
    $mysqli->close();
    ?>
</table>
<?php
phpinfo();
?>
</body>
</html>