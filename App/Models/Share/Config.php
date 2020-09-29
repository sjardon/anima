<?php

namespace App\Models\Share;

class Config{

  protected static $vars = Array();

  static function add($name,$value){
     if(empty(self::$vars[$name])){
       self::$vars[$name] = $value;
     }
  }

  static function getVar($name){
    return self::$vars[$name];
  }

  static function serVar($name,$value){
    self::$vars[$name] = $value;
  }

}


 ?>
