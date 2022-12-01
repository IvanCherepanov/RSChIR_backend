<?php

namespace mvc_app\controllers;
use mvc_app\core\Controller;

class ProductController extends Controller
{
    public function productsAction() {
        if (strpos($_SERVER['REQUEST_URI'], "?")){
            $url = trim($_SERVER['REQUEST_URI'], '/');
            echo 'da';
            $temp =  substr($url, strrpos($url, '?') + 1);
            $myArray = explode('=', $temp);
            $id = $myArray[1];

            #echo "fdsssssssssssss".$id."fdssssssss";
            $products = $this->model->readOne($id);
            $vars = [
                'products' => $products
            ];
            $this->view->render('Продукт', $vars);
        }
        else {
            $products = $this->model->getProducts();
            $vars = [
                'products' => $products
            ];
            $this->view->render('Меню', $vars);
            echo "productsController";
        }
    }

    public function apiAction(){
        $method = $_SERVER['REQUEST_METHOD'];
        #$url = $_SERVER['REQUEST_URI'];

        switch($method){
            case 'GET':
                $url = trim($_SERVER['REQUEST_URI'], '/');
                if (strpos($_SERVER['REQUEST_URI'], "?")){
                    echo 'da';
                    $temp =  substr($url, strrpos($url, '?') + 1);
                    $myArray = explode('=', $temp);
                    $id = $myArray[1];
                    #echo "fdsssssssssssss".$id."fdssssssss";
                    $vars = $this->model->readOne($id);
                    $this->view->json($vars['result'], $vars['code']);
                    break;

                }
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