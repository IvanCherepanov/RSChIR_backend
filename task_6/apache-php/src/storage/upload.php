
<?php
$uploaddir = '/var/www/html-d/storage/files/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//https://stackoverflow.com/questions/173868/how-to-get-a-files-extension-in-php

echo '<pre>';
setlocale(LC_ALL, 'en_US.UTF-8');
$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
if ($ext != "pdf") {
    echo "Выберите  pdf для загрузки";
} else {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
}

#echo 'Некоторая отладочная информация:';
#print_r($_FILES);

print "</pre>";
?>
<!--<html lang="en">-->
<!--<head>-->
<!--    <title>Загрузка</title>-->
<!--   <link rel="icon" href="--><!--" type="image/x-icon" id="fav-link">-->
<!--</head>-->
<a href="files.php">К списку</a>
