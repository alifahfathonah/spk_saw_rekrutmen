<?php

/**
 *
 */
class Profil extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    $this->data['status']  = $this->session->userdata('status');
    if (!$this->data['email'] ||  $this->data['id_role'] != 3) {
      $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
      redirect('masuk');
      exit;
    }
    $this->load->model('Pengguna_m');
    $this->data['pengguna'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);
  }

  public function index()
  {
    $this->data['title']  = 'TK Syalendra - Daftar Rekrutmen';
    $this->data['content'] = 'landing/profil';
    $this->template($this->data, 'landing');
  }

  public function password()
  {
    $this->data['title']  = 'TK Syalendra - Daftar Rekrutmen';
    $this->data['content'] = 'landing/password';
    $this->template($this->data, 'landing');
  }


  public function simpan()
  {

    if ($this->POST('simpan')) {
      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->data['pengguna']->email) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('profil/');
        exit();
      }
      $data = [
        'email' => $this->POST('email'),
        'nama_lengkap' => $this->POST('nama_lengkap'),
        'jk' => $this->POST('jk'),
        'tanggal_lahir' => $this->POST('tanggal_lahir'),
        'no_telp' => $this->POST('no_telp'),
        'alamat' => $this->POST('alamat'),
      ];
      if ($this->Pengguna_m->update($this->data['pengguna']->email, $data)) {
        $user_session = [
          'email' => $this->POST('email')
        ];
        $this->session->set_userdata($user_session);
        $this->flashmsg('Profil berhasil disimpan!', 'success');
        redirect('profil/');
        exit();
      } else {
        $this->flashmsg('Gagal, coba lagi!', 'warning');
        redirect('profil/');
        exit();
      }
    } else {
      redirect('profil');
      exit();
    }
  }

  public function simpanpass()
  {

    if ($this->POST('simpan')) {
      if ($this->Pengguna_m->update($this->data['pengguna']->email, ['password' => md5($this->POST('password'))])) {

        $this->flashmsg('Password berhasil diganti!', 'success');
        redirect('profil/');
        exit();
      } else {
        $this->flashmsg('Gagal, coba lagi!', 'warning');
        redirect('profil/');
        exit();
      }
    } else {
      redirect('profil');
      exit();
    }
  }


  public function cekemail()
  {
    echo $this->Pengguna_m->cekemailprofil($this->input->post('email'));
  }
  public function cekpasslama()
  {
    echo $this->Pengguna_m->cekpasslama($this->data['email'], $this->input->post('pass'));
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
