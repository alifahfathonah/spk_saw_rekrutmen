<?php

/**
 *
 */
class Daftar extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (isset($this->data['email'], $this->data['id_role'])) {
      if ($this->data['id_role'] == 3) {
        redirect('rekrutmen');
        exit();
      }
    }
    $this->load->model('Pengguna_m');
  }


  public function index()
  {

    if ($this->POST('daftar')) {
      $email = $this->POST('email');
      $password = $this->POST('password');
      $password2 = $this->POST('password2');

      setcookie('email_temp', $email, time() + 5, "/");
      setcookie('nama_temp', $this->POST('nama'), time() + 5, "/");
      if ($this->Pengguna_m->get_num_row(['email' => $email]) != 0) {
        $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Email telah digunakan!', 'warning');
        redirect('daftar');
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'nama_lengkap' => $this->POST('nama'),
        'password' => md5($this->POST('password2')),
        'role' => 3
      ];

      if ($this->Pengguna_m->insert($data)) {
        $id_peserta = rand(1, 9);
        for ($j = 1; $j <= 5; $j++) {
          $id_peserta .= rand(0, 9);
        }
        $data = [
          'id_peserta' => $id_peserta,
          'email' => $this->POST('email'),
          'nama_lengkap' => $this->POST('nama')
        ];


        $user_session = [
          'email' => $this->POST('email'),
          'id_role' => 3
        ];
        $this->session->set_userdata($user_session);
        $this->flashmsg('Selamat datang, proses pendaftaran akun anda berhasil, silahkan lengkapi persyaratan anda.', 'success');

        if ($this->POST('kode')) {
          redirect('rekrutmen?kode=' . $this->POST('kode'));
        } else {
          redirect('rekrutmen');
        }
        exit();
      } else {
        $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Gagal, Coba lagi!', 'warning');
        redirect('daftar');
        exit();
      }
    }

    $this->data['title']  = 'Daftar -  TK Syalendra';
    $this->data['content'] = 'landing/daftar';
    $this->template($this->data, 'landing');
  }



  public function cekemail()
  {
    echo $this->Pengguna_m->cekemail($this->input->post('email'));
  }
  public function cekpasslama()
  {
    echo $this->Pengguna_m->cekpasslama($this->data['email_peserta'], $this->input->post('pass'));
  }
  public function cekpass()
  {
    echo $this->Pengguna_m->cek_password_length($this->input->post('pass1'));
  }
  public function cekpass2()
  {
    echo $this->Pengguna_m->cek_passwords($this->input->post('pass1'), $this->input->post('pass2'));
  }
}
