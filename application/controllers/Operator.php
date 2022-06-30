<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends MY_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (!$this->data['email'] || ($this->data['id_role'] != 1)) {
      $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus masuk terlebih dahulu', 'danger');
      redirect('masuk');
      exit;
    }

    $this->load->model('Pengguna_m');
    $this->load->model('Bobot_m');
    $this->load->model('Kriteria_m');
    $this->load->model('CalonGuru_m');
    $this->load->model('Penilaian_m');
    $this->load->model('Rekrutmen_m');
    $this->load->model('Laporan_m');
    $this->load->model('DLaporan_m');

    $this->data['profil'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);

    date_default_timezone_set("Asia/Jakarta");
  }

  public function index()
  {

    $this->data['title']  = 'Dashboard - TK. Syailendra';
    $this->data['index'] = 1;
    $this->data['content'] = 'operator/dashboard';
    $this->template($this->data, 'operator');
  }

  public function spk()
  {

    $saw = $this->Lokasi_m->saw();

    $this->data['list_laptop'] = $saw['hasil_akhir'];
    $this->data['title']  = 'Hasil SPK. Metode SAW';
    $this->data['index'] = 1;
    $this->data['content'] = 'operator/spk';
    $this->template($this->data, 'operator');
  }

  public function detailspk()
  {

    $saw = $this->Lokasi_m->saw();

    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['nilai_awal'] = $saw['nilai_awal'];
    $this->data['matrik_r'] = $saw['matrik_r'];
    $this->data['list_lokasi'] = $saw['hasil'];
    $this->data['list_lokasi2'] = $saw['hasil_akhir'];
    $this->data['title']  = 'Detail Hasil SPK. Metode SAW';
    $this->data['index'] = 1;
    $this->data['content'] = 'operator/detailspk';
    $this->template($this->data, 'operator');
  }

  public function kriteria()
  {
    if ($this->POST('tambah')) {
      $data = [
        'nama_kriteria' => $this->POST('nama_kriteria'),
        'bobot_vektor' => $this->POST('bobot'),
        'tipe' => $this->POST('tipe'),
        'penilai' => $this->POST('penilai')
      ];
      $this->Kriteria_m->insert($data);
      $id = $this->db->insert_id();

      $this->flashmsg('KRITERA BERHASIL DITAMBAH!', 'success');
      redirect('operator/kriteria/' . $id);
      exit();
    }

    if ($this->POST('edit')) {
      $data = [
        'nama_kriteria' => $this->POST('nama_kriteria'),
        'bobot_vektor' => $this->POST('bobot'),
        'tipe' => $this->POST('tipe'),
        'penilai' => $this->POST('penilai')
      ];

      $this->Kriteria_m->update($this->POST('id_kriteria'), $data);

      $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
      redirect('operator/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }

    if ($this->POST('hapus')) {
      $id_kriteria = $this->POST('id_kriteria');
      $this->Kriteria_m->delete($id_kriteria);
      $this->flashmsg('Kriteria berhasil dihapus!', 'success');
      redirect('operator/kriteria/');
      exit();
    }


    if ($this->uri->segment(3)) {
      if ($this->Kriteria_m->get_num_row(['id_kriteria' => $this->uri->segment(3)]) == 1) {
        $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->uri->segment(3)]);
        $this->data['list_sub'] = $this->Bobot_m->get(['id_kriteria' => $this->uri->segment(3)]);


        $this->data['title']  = 'Kelola Kriteria - ' . $this->data['kriteria']->nama_kriteria . '';
        $this->data['index'] = 3;
        $this->data['content'] = 'operator/detailkriteria';
        $this->template($this->data, 'operator');
      } else {
        redirect('sekretariat/kriteria');
        exit();
      }
    } else {
      $this->data['list_kriteria'] = $this->Kriteria_m->get();


      $this->data['title']  = 'Kelola Data Kriteria';
      $this->data['index'] = 3;
      $this->data['content'] = 'operator/kriteria';
      $this->template($this->data, 'operator');
    }
  }

  public function bobot()
  {
    if ($this->POST('tambah')) {
      $data = [
        'keterangan' => $this->POST('ket'),
        'bobot' => $this->POST('nilai'),
        'id_kriteria' => $this->POST('id_kriteria')
      ];
      $this->Bobot_m->insert($data);

      $this->flashmsg('BOBOT KRITERA BERHASIL DITAMBAH!', 'success');
      redirect('operator/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }

    if ($this->POST('edit')) {
      $data = [
        'keterangan' => $this->POST('ket'),
        'bobot' => $this->POST('nilai'),
        'id_kriteria' => $this->POST('id_kriteria')
      ];

      $this->Bobot_m->update($this->POST('id_bobot'), $data);

      $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
      redirect('operator/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }

    if ($this->POST('hapus')) {
      $this->Bobot_m->delete($this->POST('id_bobot'));
      $this->flashmsg('DATA BOBOT KRITERA BERHASIL DIHAPUS!', 'success');
      redirect('operator/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }
  }



  public function rekrutmen()
  {

    if ($this->POST('tambah')) {

      $id = rand(1, 9);
      for ($j = 1; $j <= 4; $j++) {
        $id .= rand(0, 9);
      }

      $kode = date('dmY') . '-' . $id;

      $data = [
        'kd_rekrutmen ' => $kode,
        'judul' => $this->POST('judul'),
        'buka' => $this->POST('buka'),
        'tutup' => $this->POST('tutup'),
        'jumlah_guru' => $this->POST('jumlah_guru'),
        'tgl_buat' => date('Y-m-d H:i:s'),
        'email' => $this->data['profil']->email,
        'status' => 0
      ];

      $this->Rekrutmen_m->insert($data);
      $this->flashmsg('Data Rekrutmen berhasil ditambah!, pastikan data benar dan mulai tahap pendaftaran', 'success');
      redirect('operator/rekrutmen/' . $kode);
      exit();
    }

    if ($this->POST('edit')) {


      $kode = $this->POST('kd_rekrutmen');

      $data = [
        'judul' => $this->POST('judul'),
        'buka' => $this->POST('buka'),
        'tutup' => $this->POST('tutup'),
        'jumlah_guru' => $this->POST('jumlah_guru'),
        'keterangan' => $this->POST('editor1'),
        'persyaratan' => $this->POST('editor2')
      ];

      $this->Rekrutmen_m->update($kode, $data);

      $status = $this->Rekrutmen_m->get_row(['kd_rekrutmen' => $kode])->status;
      $this->flashmsg('Data Rekrutmen berhasil disimpan', 'success');
      if ($status == 0) {
        redirect('operator/rekrutmen/' . $kode);
      } elseif ($status == 1) {
        redirect('operator/rekrutmen/' . $kode . '?konten=datarekrutmen');
      }

      exit();
    }

    if ($this->POST('mulai1')) {


      $kode = $this->POST('kd_rekrutmen');

      $data = [
        'status' => 1
      ];

      $this->Rekrutmen_m->update($kode, $data);

      $this->flashmsg('Tahap Pendaftaran berhasil dimulai', 'success');
      redirect('operator/rekrutmen/' . $kode);
      exit();
    }

    if ($this->POST('mulai2')) {


      $kode = $this->POST('kd_rekrutmen');

      $data = [
        'status' => 2
      ];

      $this->Rekrutmen_m->update($kode, $data);

      $this->flashmsg('Tahap Pendaftaran berhasil ditutup, cek data calon guru dan mulai tahap penilaian', 'success');
      redirect('operator/rekrutmen/' . $kode);
      exit();
    }

    if ($this->POST('mulai3')) {


      $kode = $this->POST('kd_rekrutmen');

      $data = [
        'status' => 3
      ];

      $this->Rekrutmen_m->update($kode, $data);

      $this->flashmsg('Tahap Penilaian berhasil dimulai, silahkan lakukan penginputan nilai dari Operator & Kepala Sekolah', 'success');
      redirect('operator/rekrutmen/' . $kode);
      exit();
    }

    if ($this->POST('mulai4')) {


      $kode = $this->POST('kd_rekrutmen');

      $data = [
        'status' => 4
      ];

      $this->Rekrutmen_m->update($kode, $data);

      $this->flashmsg('Tahap Penilaian berhasil ditutup', 'success');
      redirect('operator/rekrutmen/' . $kode);
      exit();
    }


    if ($this->POST('mulai5')) {


      $kode = $this->POST('kd_rekrutmen');

      $rekrutmen = $this->Rekrutmen_m->get_row(['kd_rekrutmen' => $kode]);
      $list_kriteria = $this->Kriteria_m->get();
      $spk = $this->Penilaian_m->saw($kode);

      $i = 1;
      foreach ($spk['hasil_akhir'] as $s) {
        if ($i <= $rekrutmen->jumlah_guru) {
          $status = 1;
        } else {
          $status = 0;
        }
        $i++;
        $data = [
          'id_calonguru' => $s['id_calonguru'],
          'kd_rekrutmen' => $kode,
          'nilai_akhir' => $s['nilai_akhir'],
          'status' => $status,
        ];

        $this->Laporan_m->insert($data);
      }


      foreach ($spk['matrik_r'] as $s) {
        $i = 0;
        $id_laporan = $this->Laporan_m->get_row(['kd_rekrutmen' => $kode, 'id_calonguru' => $s['id_calonguru']])->id_laporan;
        foreach ($s['kriteria'] as $r) {
          $kriteria = $this->Kriteria_m->get_row(['id_kriteria' => $r]);
          $data = [
            'kriteria' => $kriteria->nama_kriteria,
            'id_laporan' => $id_laporan,
            'presentase' => $kriteria->bobot_vektor,
            'nilai' => $s['nilai'][$i]
          ];
          $this->DLaporan_m->insert($data);
          $i++;
        }

        $data = [
          'status' => 5
        ];

        $this->Rekrutmen_m->update($kode, $data);
      }


      $this->flashmsg('Rekrutmen Selesai', 'success');
      redirect('operator/rekrutmen/' . $kode);
      exit();
    }

    if ($this->POST('hapus')) {


      $kode = $this->POST('kd_rekrutmen');

      $this->Rekrutmen_m->delete($kode);



      $this->flashmsg('Data Rekrutmen berhasil dihapus', 'success');
      redirect('operator/rekrutmen/');
      exit();
    }

    if ($this->POST('simpannilai')) {

      $id_calonguru = $this->POST('id_calonguru');
      $kd_rekrutmen = $this->POST('kd_rekrutmen');
      $list_kriteria = $this->Kriteria_m->get(['penilai' => 'Operator']);

      foreach ($list_kriteria as $k) {

        if ($this->Penilaian_m->get_num_row(['id_calonguru' => $id_calonguru, 'kd_rekrutmen' => $kd_rekrutmen, 'id_kriteria' => $k->id_kriteria]) == 0) {
          $data = [
            'id_calonguru' => $id_calonguru,
            'kd_rekrutmen' => $kd_rekrutmen,
            'id_kriteria' => $k->id_kriteria,
            'id_bobot' => $this->POST('kriteria_' . $k->id_kriteria),
            'keterangan' => NULL
          ];
          $this->Penilaian_m->insert($data);
        } else {
          $d = $this->Penilaian_m->get_row(['id_calonguru' => $id_calonguru, 'kd_rekrutmen' => $kd_rekrutmen, 'id_kriteria' => $k->id_kriteria]);
          $data = [
            'id_bobot' => $this->POST('kriteria_' . $k->id_kriteria),
            'keterangan' => NULL
          ];
          $this->Penilaian_m->update($d->id_penilaian, $data);
        }
      }


      $this->flashmsg('Data nilai berhasil disimpan', 'success');
      redirect('operator/rekrutmen/' . $kd_rekrutmen . '?konten=calonguru&id=' . $id_calonguru . '&formnilai=y');
      exit();
    }

    if ($this->uri->segment(3)) {
      $kd = $this->uri->segment(3);

      if ($this->Rekrutmen_m->get_num_row(['kd_rekrutmen' => $kd]) == 0) {
        $this->flashmsg('Data Rekrutmen tidak tersedia', 'warning');
        redirect('operator/rekrutmen');
        exit;
      }

      $this->data['rekrutmen'] = $this->Rekrutmen_m->get_row(['kd_rekrutmen' => $kd]);
      $this->data['list_kriteria'] = $this->Kriteria_m->get();
      $this->data['title']  = $this->data['rekrutmen']->judul;
      $this->data['index'] = 2;
      $this->data['content'] = 'operator/detailrekrutmen';
      $this->template($this->data, 'operator');
    } else {
      $this->data['list_rekrutmen'] = $this->Rekrutmen_m->get_by_order('tgl_buat', 'desc', []);
      $this->data['title']  = 'Data Rekrutmen';
      $this->data['index'] = 2;
      $this->data['content'] = 'operator/rekrutmen';
      $this->template($this->data, 'operator');
    }
  }

  public function pengguna()
  {

    if ($this->POST('tambah')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('operator/pengguna');
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'password' => md5($this->POST('password')),
        'nama_lengkap' => $this->POST('nama_lengkap'),
        'jk' => $this->POST('jk'),
        'tanggal_lahir' => $this->POST('tanggal_lahir'),
        'no_telp' => $this->POST('no_telp'),
        'foto' => 'foto/default.jpg',
        'role' => $this->POST('role')
      ];
      $this->Pengguna_m->insert($data);
      $id = $this->db->insert_id();

      $this->flashmsg('Data Pengguna berhasil ditambah!', 'success');
      redirect('operator/pengguna/' . $id);
      exit();
    } elseif ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('operator/pengguna/' . $this->POST('id_pengguna'));
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'password' => md5($this->POST('password')),
        'nama_lengkap' => $this->POST('nama_lengkap'),
        'jk' => $this->POST('jk'),
        'tanggal_lahir' => $this->POST('tanggal_lahir'),
        'no_telp' => $this->POST('no_telp'),
        'foto' => 'foto/default.jpg',
        'role' => $this->POST('role')
      ];
      $this->Pengguna_m->update($this->POST('email'), $data);

      $this->flashmsg('Data Pengguna berhasil disimpan!', 'success');
      redirect('operator/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('uploadfoto')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      if ($_FILES['foto']['name'] !== '') {
        $files = $_FILES['foto'];
        $_FILES['foto']['name'] = $files['name'];
        $_FILES['foto']['type'] = $files['type'];
        $_FILES['foto']['tmp_name'] = $files['tmp_name'];
        $_FILES['foto']['size'] = $files['size'];

        $id_foto = rand(1, 9);
        for ($j = 1; $j <= 6; $j++) {
          $id_foto .= rand(0, 9);
        }

        if ($profils->foto != 'foto/default.jpg' && $profils->foto != 'foto/default-l.jpg' && $profils->foto != 'foto/default-p.jpg') {
          @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
        }
        $this->upload($id_foto, 'foto/', 'foto');
        $this->Pengguna_m->update($profils->email, ['foto' => 'foto/' . $id_foto . '.jpg']);
        $this->flashmsg('Foto Profil berhasil diupload!', 'success');


        redirect('operator/pengguna/' . $this->POST('id_pengguna'));
        exit();
      } else {
        redirect('operator/pengguna/' . $this->POST('id_pengguna'));
        exit();
      }
    } elseif ($this->POST('hapusfoto')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
      $this->Pengguna_m->update($profils->email, ['foto' => 'foto/default.jpg']);
      $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
      redirect('operator/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('edit2')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);
      $data = [
        'password' => md5($this->POST('pass1'))
      ];

      $this->Pengguna_m->update($profils->email, $data);

      $this->flashmsg('Password baru telah tersimpan!', 'success');
      redirect('operator/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('hapus')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      $this->Pengguna_m->delete($profils->email);
      $this->flashmsg('Data Pengguna berhasil dihapus!', 'success');
      redirect('operator/pengguna/');
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data pengguna tidak ditemukan!', 'danger');
        redirect('operator/pengguna');
        exit();
      }

      $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['title']  = 'Detail Data Pengguna - ' . $this->data['pengguna']->nama_lengkap;
      $this->data['index'] = 5;
      $this->data['content'] = 'operator/detailpengguna';
      $this->template($this->data, 'operator');
    } else {
      $this->data['list_pengguna'] = $this->Pengguna_m->get(['email !=' => $this->data['email'], 'role !=' => 3]);
      $this->data['title']  = 'Kelola Data Pengguna';
      $this->data['index'] = 5;
      $this->data['content'] = 'operator/pengguna';
      $this->template($this->data, 'operator');
    }
  }


  public function downloadberkas()
  {
    $peserta = $this->CalonGuru_m->get_row(['id_calonguru' => $this->uri->segment(3)]);
    $data = glob('berkas/' . $peserta->id_calonguru . '_' . $peserta->kd_rekrutmen . '/*');

    $this->load->library('zip');
    foreach ($data as $d) {
      $this->zip->read_file($d);
    }

    $this->zip->download($peserta->kd_rekrutmen . '_' . $peserta->id_calonguru . '.zip');
  }

  public function profil()
  {

    $this->data['title']  = 'Account';
    $this->data['index'] = 6;
    $this->data['content'] = 'operator/profil';
    $this->template($this->data, 'operator');
  }

  public function proses_edit_profil()
  {
    if ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('operator/profil');
        exit();
      }

      $data = [
        'nama_lengkap' => $this->POST('nama_lengkap'),
        'email' => $this->POST('email'),
        'jk' => $this->POST('jk'),
        'no_telp' => $this->POST('no_telp'),
        'tanggal_lahir' => $this->POST('tanggal_lahir')
      ];

      $this->Pengguna_m->update($this->POST('email_x'), $data);


      $user_session = [
        'email' => $this->POST('email'),
      ];
      $this->session->set_userdata($user_session);


      $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
      redirect('operator/profil');
      exit();
    } elseif ($this->POST('uploadfoto')) {
      if ($_FILES['foto']['name'] !== '') {
        $files = $_FILES['foto'];
        $_FILES['foto']['name'] = $files['name'];
        $_FILES['foto']['type'] = $files['type'];
        $_FILES['foto']['tmp_name'] = $files['tmp_name'];
        $_FILES['foto']['size'] = $files['size'];

        $id_foto = rand(1, 9);
        for ($j = 1; $j <= 6; $j++) {
          $id_foto .= rand(0, 9);
        }

        if ($this->data['profil']->foto != 'foto/default.jpg' && $this->data['profil']->foto != 'foto/default-l.jpg' && $this->data['profil']->foto != 'foto/default-p.jpg') {
          @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
        }
        $this->upload($id_foto, 'foto/', 'foto');
        $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/' . $id_foto . '.jpg']);
        $this->flashmsg('Foto Profil berhasil diupload!', 'success');
        redirect('operator/profil');
        exit();
      } else {
        redirect('operator/profil');
        exit();
      }
    } elseif ($this->POST('hapusfoto')) {

      @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
      $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/default.jpg']);
      $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
      redirect('operator/profil');
      exit();
    } elseif ($this->POST('edit2')) {
      $data = [
        'password' => md5($this->POST('pass1'))
      ];

      $this->Pengguna_m->update($this->data['email'], $data);

      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('operator/profil');
      exit();
    } else {

      redirect('operator/profil');
      exit();
    }
  }




  public function cekpasslama()
  {
    echo $this->Pengguna_m->cekpasslama($this->data['email'], $this->input->post('pass'));
  }
  public function cekpass()
  {
  }
  public function cekpass2()
  {
    echo $this->Pengguna_m->cek_passwords($this->input->post('pass1'), $this->input->post('pass2'));
  }
}
