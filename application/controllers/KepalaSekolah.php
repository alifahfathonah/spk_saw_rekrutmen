<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KepalaSekolah extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role');
        if (!$this->data['email'] || ($this->data['id_role'] != 2)) {
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

        //$saw = $this->Lokasi_m->saw();

        //$this->data['list_lokasi'] = $saw['hasil_akhir'];
        $this->data['title']  = 'Dashboard - TK. Syailendra';
        $this->data['index'] = 1;
        $this->data['content'] = 'kepalasekolah/dashboard';
        $this->template($this->data, 'kepalasekolah');
    }

    public function spk()
    {

        $saw = $this->Lokasi_m->saw();

        $this->data['list_laptop'] = $saw['hasil_akhir'];
        $this->data['title']  = 'Hasil SPK. Metode SAW';
        $this->data['index'] = 1;
        $this->data['content'] = 'kepalasekolah/spk';
        $this->template($this->data, 'kepalasekolah');
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
        $this->data['content'] = 'kepalasekolah/detailspk';
        $this->template($this->data, 'kepalasekolah');
    }

    public function rekrutmen()
    {


        if ($this->POST('simpannilai')) {

            $id_calonguru = $this->POST('id_calonguru');
            $kd_rekrutmen = $this->POST('kd_rekrutmen');
            $list_kriteria = $this->Kriteria_m->get(['penilai' => 'Kepala Sekolah']);

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
            redirect('kepalasekolah/rekrutmen/' . $kd_rekrutmen . '?konten=calonguru&id=' . $id_calonguru . '&formnilai=y');
            exit();
        }

        if ($this->uri->segment(3)) {
            $kd = $this->uri->segment(3);

            if ($this->Rekrutmen_m->get_num_row(['kd_rekrutmen' => $kd]) == 0) {
                $this->flashmsg('Data Rekrutmen tidak tersedia', 'warning');
                redirect('kepalasekolah/rekrutmen');
                exit;
            }

            $this->data['rekrutmen'] = $this->Rekrutmen_m->get_row(['kd_rekrutmen' => $kd]);
            $this->data['list_kriteria'] = $this->Kriteria_m->get();
            $this->data['title']  = $this->data['rekrutmen']->judul;
            $this->data['index'] = 2;
            $this->data['content'] = 'kepalasekolah/detailrekrutmen';
            $this->template($this->data, 'kepalasekolah');
        } else {
            $this->data['list_rekrutmen'] = $this->Rekrutmen_m->get_by_order('tgl_buat', 'desc', ['status >=' => 3]);
            $this->data['title']  = 'Data Rekrutmen';
            $this->data['index'] = 2;
            $this->data['content'] = 'kepalasekolah/rekrutmen';
            $this->template($this->data, 'kepalasekolah');
        }
    }

    public function pengguna()
    {

        if ($this->POST('tambah')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('kepalasekolah/pengguna');
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
            redirect('kepalasekolah/pengguna/' . $id);
            exit();
        } elseif ($this->POST('edit')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('kepalasekolah/pengguna/' . $this->POST('id_pengguna'));
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
            redirect('kepalasekolah/pengguna/' . $this->POST('id_pengguna'));
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


                redirect('kepalasekolah/pengguna/' . $this->POST('id_pengguna'));
                exit();
            } else {
                redirect('kepalasekolah/pengguna/' . $this->POST('id_pengguna'));
                exit();
            }
        } elseif ($this->POST('hapusfoto')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

            @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
            $this->Pengguna_m->update($profils->email, ['foto' => 'foto/default.jpg']);
            $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
            redirect('kepalasekolah/pengguna/' . $this->POST('id_pengguna'));
            exit();
        } elseif ($this->POST('edit2')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);
            $data = [
                'password' => md5($this->POST('pass1'))
            ];

            $this->Pengguna_m->update($profils->email, $data);

            $this->flashmsg('Password baru telah tersimpan!', 'success');
            redirect('kepalasekolah/pengguna/' . $this->POST('id_pengguna'));
            exit();
        } elseif ($this->POST('hapus')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

            $this->Pengguna_m->delete($profils->email);
            $this->flashmsg('Data Pengguna berhasil dihapus!', 'success');
            redirect('kepalasekolah/pengguna/');
            exit();
        } else if ($this->uri->segment(3)) {

            if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->uri->segment(3)]) == 0) {
                $this->flashmsg('Data pengguna tidak ditemukan!', 'danger');
                redirect('kepalasekolah/pengguna');
                exit();
            }

            $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
            $this->data['title']  = 'Detail Data Pengguna - ' . $this->data['pengguna']->nama_lengkap;
            $this->data['index'] = 5;
            $this->data['content'] = 'kepalasekolah/detailpengguna';
            $this->template($this->data, 'kepalasekolah');
        } else {
            $this->data['list_pengguna'] = $this->Pengguna_m->get(['email !=' => $this->data['email'], 'role !=' => 3]);
            $this->data['title']  = 'Kelola Data Pengguna';
            $this->data['index'] = 5;
            $this->data['content'] = 'kepalasekolah/pengguna';
            $this->template($this->data, 'kepalasekolah');
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
        $this->data['content'] = 'kepalasekolah/profil';
        $this->template($this->data, 'kepalasekolah');
    }

    public function proses_edit_profil()
    {
        if ($this->POST('edit')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('kepalasekolah/profil');
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
            redirect('kepalasekolah/profil');
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
                redirect('kepalasekolah/profil');
                exit();
            } else {
                redirect('kepalasekolah/profil');
                exit();
            }
        } elseif ($this->POST('hapusfoto')) {

            @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
            $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/default.jpg']);
            $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
            redirect('kepalasekolah/profil');
            exit();
        } elseif ($this->POST('edit2')) {
            $data = [
                'password' => md5($this->POST('pass1'))
            ];

            $this->Pengguna_m->update($this->data['email'], $data);

            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('kepalasekolah/profil');
            exit();
        } else {

            redirect('kepalasekolah/profil');
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
