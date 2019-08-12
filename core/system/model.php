<?php
/*
  model base
*/
class Model {
  protected $date;
  protected $Connect;
  public function __construct(){
    $this->date = time();
    $this->Connect = new Connect();
  }


  public function prepare($sql){
    return $this->Connect->real_escape_string($sql);
  }


  public function set_list($state){
    $this->Connect->set_list($state);
  }

  
  public function fetch($sql){
    return $this->Connect->fetch($sql);
  }
}
