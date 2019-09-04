<?php

class test_controller extends controller {

  public function execute (){
    $Platzi = new Platzi();

    $simple_posts = $Platzi->get_posts(1);

    

  }

}
