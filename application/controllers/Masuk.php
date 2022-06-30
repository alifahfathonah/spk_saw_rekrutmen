<?php 
class Masuk extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['email'], $this->data['id_role']))
    { 
      if ($this->data['id_role'] == 1) { 
          redirect('operator');
          exit();
      }elseif ($this->data['id_role'] == 2) { 
          redirect('kepalasekolah');
          exit();
      } if ($this->data['id_role'] == 3) { 
          redirect('rekrutmen');
          exit();
      } 
    }
    $this->load->model('Pengguna_m');   
   
  }


  public function cek(){
      if ($this->POST('login')) {
        $email = $this->POST('email');
        $password = $this->POST('password');
        if($this->Pengguna_m->cek_login($email,$password) == 0){
          $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> email tidak terdaftar!', 'danger');
          redirect('masuk');
          exit;
        }else if($this->Pengguna_m->cek_login($email,$password) == 1){
          setcookie('email_temp', $email, time() + 5, "/");
          $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Password Salah!', 'danger');
          redirect('masuk');
          exit;
        }else{
          redirect('masuk');
          exit();
        }
      }else{
        redirect('masuk');
        exit();
      }
  }

  public function index() {  
 
      $this->data['title']  = 'Masuk -  TK Syalendra';  
      $this->data['content'] = 'landing/masuk';
      $this->template($this->data,'landing');
  }
}
