<?php
// controlador base
class controller {
  protected $data = [];
  protected $params = [];
  protected $session;
  public function __construct ($params){
    $this->params = $params;
    $this->mapData();
  }
  //private function
  private function mapData(){
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);
    if($data) $this->data = $data;
  }

  //responder cliente
  //entry: [data]
  //response data::json
  public function response($data){
    echo json_encode($data);
    exit();
  }
  public function response_error($error_descript = 'error interno del servidor', $code = 505){
    $response = [
      'error' => true,
      'errorCode' => $code,
      'errorDescript' => $error_descript
    ];
    $this->response($response);
  }


  //verificador de session
  //entry: $this->data->id_user && token
  //muted: $this->session || response error
  public function session(){
    $exist = !empty($this->data['id_user']) && !empty($this->data['token']);
    if (!$exist) $this->response(['error' => true, 'errorCode' => 403, 'errorMessage' => 'not autorized']);
    $Security = new Security();
    $Security->set_token($this->data['token']);
    $Security->set_id($this->data['id_user']);
    $uotorized = $Security->authorize();
    if(!$uotorized) $this->response(['error' => true, 'errorCode' => 403, 'errorMessage' => 'not autorized!']);
    $this->session = (int) $this->data['id_user'];
    return true;
  }


  public function validate ($arrayofnames, $type = 'data'){
    if ($type === 'data'){
      foreach ($arrayofnames as $name) {
        if (empty($this->data[$name])){
          $this->response([
            'error' => true,
            'errorMessage' => 'Faltan datos ncesesarios en data',
            'errorCode' => 403,
          ]);
        }
      }
    }else{
      foreach ($arrayofnames as $name) {
        if (empty($this->params[$name])){
          $this->response([
            'error' => true,
            'errorMessage' => 'Faltan datos ncesesarios en params',
            'errorCode' => 403,
          ]);
        }
      }
    }
  }

  
}
