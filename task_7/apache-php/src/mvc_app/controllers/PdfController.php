<?php

namespace mvc_app\controllers;

use \mvc_app\core\Controller;

class PdfController extends Controller
{
    public function showAction() {
        $this->view->render('Хранилище');
    }

    public function uploadAction(){
        $result = $this->model->uploadFile();
        $vars = ["result" => $result];
        $this->view->render("Страница после загрузки", $vars);
    }
}