<?php namespace App\Controllers;

class TestController extends \App\Controllers\AbstractController{

  public function index(){

  }

  public function show($testId=false,$dociId=false){
    echo "show\n";
    var_dump($testId,$dociId);

  }

  public function store($testId=false,$dociId=false){
    echo "store\n";

    var_dump($testId,$dociId);

  }

  public function update($testId=false,$dociId=false){
    echo "update\n";

    var_dump($testId,$dociId);

  }

  public function destroy($testId=false,$dociId=false){
    echo "destroy\n";
    

    var_dump($testId,$dociId);


  }


}

?>
