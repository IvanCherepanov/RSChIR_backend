<?php

namespace app\controllers;
use yii\rest;

class UserapiController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\User';
}