<?php

namespace app\controllers;
use yii\rest;

class ProductapiController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Product';
}