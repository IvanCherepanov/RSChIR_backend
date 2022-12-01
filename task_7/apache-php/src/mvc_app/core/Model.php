<?php

namespace mvc_app\core;

use mvc_app\lib\Db;
use mysqli;

abstract class Model {

    public $db;

    public function __construct() {
        $this->db = new Db;
    }

}