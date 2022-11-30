<?php

namespace mvc_app\core;

use mvc_app\lib\Db;

abstract class Model {

    public $db;

    public function __construct() {
        $this->db = new Db;
    }

}