<?php

namespace App\Models\Share\Validator;

class Validations
{
    private $validations = Array();
    private static $instance;


    private function __construct() {
        $this->validations = array();
    }

    public function add($name, $validation) {
        if(!isset($this->validations[$name])) {
            $this->validations[$name] = $validation;
        }
    }

    public function get($name) {
        if(isset($this->validations[$name])) {
            return $this->validations[$name];
        }
    }

    public static function getInstance(){
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class();
        }
        return self::$instance;
    }
}


 ?>
