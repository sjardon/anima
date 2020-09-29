<?php namespace \App\Models;


abstract class AbstractModel{


  public function toJson($parents = array()){
    $json = array();
    foreach($this as $key => $value) {
      f_toJson($key,$value,$parents,$this,$json);
    }

    return $json;
  }
}

?>
