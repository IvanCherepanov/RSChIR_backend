<?php

namespace mvc_app\models;

use mvc_app\core\Model;

class Pdf extends Model
{
    public function uploadFile()
    {
        $uploaddir = 'mvc_app/storage/files/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        setlocale(LC_ALL, 'en_US.UTF-8');
        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);

        if ($ext != "pdf") {
            return "Только pdf файлы доступны к загрузке\n";
        }
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            return "Файл " . htmlspecialchars(basename($_FILES["userfile"]["name"])) . " был успешно загружен.";
        } else {
            return "Возможная атака с помощью файловой загрузки!\n";
        }

    }
}