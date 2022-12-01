<?php

namespace mvc_app\controllers;
use mvc_app\core\Controller;

class AdminController extends Controller
{
    public function usersAction() {
        $users = $this->model->getUsers();
        $vars = [
            'users' => $users
        ];
        $this->view->render('Панель администратора', $vars);
    }

    public function apiAction(){
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        switch($method){
            case 'GET':
                $url_data = parse_url($url, PHP_URL_QUERY);
                echo $url_data;
                $vars = $this->model->read();
                $this->view->json($vars['result'], $vars['code']);
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                $vars = $this->model->create($data);
                $this->view->json($vars['result'], $vars['code']);
                break;
            case 'PATCH':
                $data = json_decode(file_get_contents("php://input"));
                $vars = $this->model->update($data);
                $this->view->json($vars['result'], $vars['code']);
                break;
            case 'DELETE':
//                $mas = (parse_url($url, PHP_URL_PATH));
//                $item = explode('/', $mas);
//                $id = array_pop($item);
//                echo $id;
                $data = json_decode(file_get_contents("php://input"));
                $vars = $this->model->delete($data);
                $this->view->json($vars['result'], $vars['code']);
                break;
            default:
                http_response_code(405);
                $vars = [
                    "result"=> json_encode(array("message" => "Неверный http метод")),
                    "code" => 405
                ];
                echo json_encode(array("message" => "Неверный http метод"));
                $this->view->json($vars['result'], $vars['code']);
                break;
        }
    }
}