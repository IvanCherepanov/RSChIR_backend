<?php
require_once '../utilsMySql.php';
?>

<?php
$themeStyleSheet = 'http://localhost:8006/main.css';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
    $themeStyleSheet = 'http://localhost:8006/dark.css';
}
$favicon = "http://localhost:8006/img/hp.png";
if (!empty($_COOKIE['fav']) && $_COOKIE['fav'] == 'witcher') {
    $favicon = "http://localhost:8006/img/witch.png";
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
<form enctype="multipart/form-data" action="upload.php" method="POST">
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
        <br>
        <label class="custom-file-label" for="file_field">Отправить этот файл:</label>
        <br>
        <input class="custom-file-input" id="file_field" name="userfile" type="file"/>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Отправить файл"/>
</form>
<h1>Таблица загруженных файлов</h1>
<table>
    <tr>
        <th>Name</th>
        <th></th>
    </tr>
    <?php
    $files = scandir('./files');
    if (count($files) <= 2) {
        echo "<h2>Нет загруженных файлов</h2>";
    } else {
        echo "<h2>Загруженные файлы</h2>";
        foreach ($files as $file) {
            if ($file != "." and $file != "..") {
            echo "<tr><td><a  href='./files/".$file."'>".$file."</a></td></tr>";
            }
        }
    }
    ?>
</table>
<?php
phpinfo();
?>
</body>
</html>
