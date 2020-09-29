<?php

namespace App\Models\Share\Http;

class Response{

  protected $header;
  protected $body;
  protected $status;

  public function __construct($header=false,$body=false,$status=false){
    $this->header = $header;
    $this->body = $body;
    $this->status = $status;
  }

  public function setHeader($header){
    $this->header = $header;
  }

  public function setBody($body){
    $this->body = $body;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getHeader(){
    return $this->header;
  }

  public function getBody(){
    return $this->body;
  }

  public function getStatus(){
    return $this->status;
  }

  public function header($name,$value){
    if(!is_array($this->header)){
      $this->header = Array();
    }

    $this->header[$name] = $value;

  }

  public function body($data){
    $this->body = $data;
  }

  public function send(){

    if(is_array($this->header)){
      foreach($this->header as $name => $head){
        header("$name: $head");
      }
    }

    if($this->status){
      header("HTTP/1.0 {$this->status}");
    }

    echo $this->body;
  }

}

 ?>
