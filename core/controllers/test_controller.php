<?php


class test_controller {

  public function execute (){

    $Platzi = new Platzi();
    $Sync = new Sync();
    var_dump($Platzi->get_posts(1));

  }



}
