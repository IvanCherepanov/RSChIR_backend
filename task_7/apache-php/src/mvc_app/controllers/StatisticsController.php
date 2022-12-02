<?php

namespace mvc_app\controllers;
use mvc_app\core\Controller;

class StatisticsController extends \mvc_app\core\Controller
{
    public function showAction() {
        $vars = ["images" => $this->model->drawImages()];
        $this->view->render('Статистика', $vars);
    }
}