<?php

class Connect  extends mysqli {
  private $list = false;

  public function set_list($state = true){
    $this->list = $state;
  }

  public function __construct() {
    parent::__construct (DB_HOST, DB_USER, DB_PASS,DB_NAME );
    $this->set_charset(DB_CHARSET);
  }
  
  public function __destruct (){
    $this->close();
  }

  // create
  // params:: sql,
  // return:: create item id
  public function create ($sql) {
    $state =  $this->query($sql);
    return $state
    ? $this->insert_id
    : $state;
  }

  // set
  // params:: sql,
  // return:: state[bolean];
  public function set ($sql) {
    $state =  $this->query($sql);
    return $state;
  }

  public function fetch($sql){
    $state = $this->query($sql);
    if (!$state) return false;  //verifica si no hay error
    $data = $state->fetch_all(MYSQLI_ASSOC);
    $items = $state->num_rows;
    if (!$items) return false; //resultado 0
    if ($this->list){
      return $data;
    } else {
      return $items > 1
      ? $data     //muchos resultados
      : $data[0]; // 1 solo re3sultado
    }
  }
}
