<?php

/**
 *
 */
class Rekrutmen extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rekrutmen_m');
        $this->load->model('Pengguna_m');
        $this->load->model('CalonGuru_m');

        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role');
        if (isset($this->data['email'], $this->data['id_role'])) {
            if ($this->data['id_role'] == 3) {
                $this->data['profil'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);
                $this->data['ceklog'] = 1;
            } else {
                $this->data['ceklog'] = 0;
            }
        } else {

            $this->data['ceklog'] = 0;
        }
    }


    public function index()
    {
        $this->data['list_rekrutmen'] = $this->Rekrutmen_m->get_by_order('tgl_buat', 'desc', ['status' => 1]);
        $this->data['title']  = 'TK Syalendra - Daftar Rekrutmen';
        $this->data['content'] = 'landing/rekrutmen';
        $this->template($this->data, 'landing');
    }

    public function kirim()
    {
        if ($this->POST('kirim')) {
            $calonguru = $this->CalonGuru_m->get_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]);

            $this->CalonGuru_m->update($calonguru->id_calonguru, ['status' => 1]);
            $this->flashmsg('Lamaran berhasil dikirim !', 'success');
            redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen'));
            exit();
        } else {
            redirect('rekrutmen');
            exit;
        }
    }


    public function unggah()
    {

        if ($this->POST('unggah1')) {
            if ($_FILES['suratlamaran']['name'] !== '') {
                $files = $_FILES['suratlamaran'];
                $type = $files['type'];
                if ($type == "application/pdf") {

                    $_FILES['suratlamaran']['name'] = $files['name'];
                    $_FILES['suratlamaran']['type'] = $files['type'];
                    $_FILES['suratlamaran']['tmp_name'] = $files['tmp_name'];
                    $_FILES['suratlamaran']['size'] = $files['size'];

                    $id = rand(1, 9);
                    for ($j = 1; $j <= 6; $j++) {
                        $id .= rand(0, 9);
                    }


                    if ($this->CalonGuru_m->get_num_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]) == 0) {
                        $this->CalonGuru_m->insert(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen'), 'status' => 0]);
                    }

                    $calonguru = $this->CalonGuru_m->get_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]);


                    if (!is_dir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen)) {
                        mkdir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen, 0777, TRUE);
                    }
                    $upload_path = realpath(APPPATH . '../berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen);


                    if ($calonguru->surat_lamaran != NULL) {
                        unlink('./' . $calonguru->surat_lamaran);
                    }

                    $name = 'surat_lamaran.pdf';
                    $config = [
                        'file_name'     => $name,
                        'allowed_types'   => 'pdf',
                        'upload_path'   => $upload_path
                    ];
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('suratlamaran')) {
                        $this->CalonGuru_m->update($calonguru->id_calonguru, ['surat_lamaran' => 'berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen . '/' . $name, 'nama_suratlamaran' => $name]);
                        $this->flashmsg('Surat Lamaran berhasil diunggah !', 'success');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        $this->flashmsg('Gagal, Coba lagi !', 'warning');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    }
                } else {
                    $this->flashmsg('Format surat lamaran  harus .pdf   !', 'warning');
                    redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                    exit();
                }
            } else {
                redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                exit();
            }
        } elseif ($this->POST('unggah2')) {
            if ($_FILES['cv']['name'] !== '') {
                $files = $_FILES['cv'];
                $type = $files['type'];
                if ($type == "application/pdf") {

                    $_FILES['cv']['name'] = $files['name'];
                    $_FILES['cv']['type'] = $files['type'];
                    $_FILES['cv']['tmp_name'] = $files['tmp_name'];
                    $_FILES['cv']['size'] = $files['size'];

                    $id = rand(1, 9);
                    for ($j = 1; $j <= 6; $j++) {
                        $id .= rand(0, 9);
                    }


                    if ($this->CalonGuru_m->get_num_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]) == 0) {
                        $this->CalonGuru_m->insert(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen'), 'status' => 0]);
                    }

                    $calonguru = $this->CalonGuru_m->get_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]);


                    if (!is_dir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen)) {
                        mkdir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen, 0777, TRUE);
                    }
                    $upload_path = realpath(APPPATH . '../berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen);


                    if ($calonguru->cv != NULL) {
                        unlink('./' . $calonguru->cv);
                    }

                    $name = 'cv.pdf';
                    $config = [
                        'file_name'     => $name,
                        'allowed_types'   => 'pdf',
                        'upload_path'   => $upload_path
                    ];
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('cv')) {
                        $this->CalonGuru_m->update($calonguru->id_calonguru, ['cv' => 'berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen . '/' . $name, 'nama_cv' => $name]);
                        $this->flashmsg('Curriculum Vitae berhasil diunggah !', 'success');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        $this->flashmsg('Gagal, Coba lagi !', 'warning');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    }
                } else {
                    $this->flashmsg('Format surat lamaran  harus .pdf   !', 'warning');
                    redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                    exit();
                }
            } else {
                redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                exit();
            }
        } elseif ($this->POST('unggah3')) {
            if ($_FILES['ijazah_terakhir']['name'] !== '') {
                $files = $_FILES['ijazah_terakhir'];
                $type = $files['type'];
                if ($type == "application/pdf") {

                    $_FILES['ijazah_terakhir']['name'] = $files['name'];
                    $_FILES['ijazah_terakhir']['type'] = $files['type'];
                    $_FILES['ijazah_terakhir']['tmp_name'] = $files['tmp_name'];
                    $_FILES['ijazah_terakhir']['size'] = $files['size'];

                    $id = rand(1, 9);
                    for ($j = 1; $j <= 6; $j++) {
                        $id .= rand(0, 9);
                    }


                    if ($this->CalonGuru_m->get_num_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]) == 0) {
                        $this->CalonGuru_m->insert(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen'), 'status' => 0]);
                    }

                    $calonguru = $this->CalonGuru_m->get_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]);


                    if (!is_dir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen)) {
                        mkdir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen, 0777, TRUE);
                    }
                    $upload_path = realpath(APPPATH . '../berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen);


                    if ($calonguru->ijazah_terakhir != NULL) {
                        unlink('./' . $calonguru->ijazah_terakhir);
                    }

                    $name = 'ijazah_terakhir.pdf';
                    $config = [
                        'file_name'     => $name,
                        'allowed_types'   => 'pdf',
                        'upload_path'   => $upload_path
                    ];
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('ijazah_terakhir')) {
                        $this->CalonGuru_m->update($calonguru->id_calonguru, ['ijazah_terakhir' => 'berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen . '/' . $name, 'nama_ijazah' => $name]);
                        $this->flashmsg('Ijazah Terakhir berhasil diunggah !', 'success');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        $this->flashmsg('Gagal, Coba lagi !', 'warning');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    }
                } else {
                    $this->flashmsg('Format surat lamaran  harus .pdf   !', 'warning');
                    redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                    exit();
                }
            } else {
                redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                exit();
            }
        } elseif ($this->POST('unggah4')) {
            if ($_FILES['ktp']['name'] !== '') {
                $files = $_FILES['ktp'];
                $type = $files['type'];
                if ($type == "application/pdf" || $type == "image/jpeg" || $type == "image/jpg" || $type == "image/png") {

                    $_FILES['ktp']['name'] = $files['name'];
                    $_FILES['ktp']['type'] = $files['type'];
                    $_FILES['ktp']['tmp_name'] = $files['tmp_name'];
                    $_FILES['ktp']['size'] = $files['size'];

                    $id = rand(1, 9);
                    for ($j = 1; $j <= 6; $j++) {
                        $id .= rand(0, 9);
                    }


                    if ($this->CalonGuru_m->get_num_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]) == 0) {
                        $this->CalonGuru_m->insert(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen'), 'status' => 0]);
                    }

                    $calonguru = $this->CalonGuru_m->get_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]);


                    if (!is_dir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen)) {
                        mkdir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen, 0777, TRUE);
                    }
                    $upload_path = realpath(APPPATH . '../berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen);


                    if ($calonguru->ktp != NULL) {
                        unlink('./' . $calonguru->ktp);
                    }
                    if ($type == "application/pdf") {
                        $name = 'ktp.pdf';
                    } elseif ($type == "image/jpeg" || $type == "image/jpg") {
                        $name = 'ktp.jpg';
                    } elseif ($type == "image/png") {
                        $name = 'ktp.png';
                    }
                    $config = [
                        'file_name'     => $name,
                        'allowed_types'   => 'pdf|jpeg|png|jpg|',
                        'upload_path'   => $upload_path
                    ];
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('ktp')) {
                        $this->CalonGuru_m->update($calonguru->id_calonguru, ['ktp' => 'berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen . '/' . $name, 'nama_ktp' => $name]);
                        $this->flashmsg('KTP berhasil diunggah !', 'success');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        $this->flashmsg('Gagal, Coba lagi !', 'warning');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    }
                } else {
                    $this->flashmsg('Format surat lamaran  harus .pdf   !', 'warning');
                    redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                    exit();
                }
            } else {
                redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                exit();
            }
        } elseif ($this->POST('unggah5')) {
            if ($_FILES['berkas_lainnya']['name'] !== '') {
                $files = $_FILES['berkas_lainnya'];
                $type = $files['type'];
                if ($type == "application/pdf") {

                    $_FILES['berkas_lainnya']['name'] = $files['name'];
                    $_FILES['berkas_lainnya']['type'] = $files['type'];
                    $_FILES['berkas_lainnya']['tmp_name'] = $files['tmp_name'];
                    $_FILES['berkas_lainnya']['size'] = $files['size'];

                    $id = rand(1, 9);
                    for ($j = 1; $j <= 6; $j++) {
                        $id .= rand(0, 9);
                    }


                    if ($this->CalonGuru_m->get_num_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]) == 0) {
                        $this->CalonGuru_m->insert(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen'), 'status' => 0]);
                    }

                    $calonguru = $this->CalonGuru_m->get_row(['email' => $this->data['email'], 'kd_rekrutmen' => $this->POST('kd_rekrutmen')]);


                    if (!is_dir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen)) {
                        mkdir('berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen, 0777, TRUE);
                    }
                    $upload_path = realpath(APPPATH . '../berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen);


                    if ($calonguru->berkas_lainnya != NULL) {
                        unlink('./' . $calonguru->berkas_lainnya);
                    }

                    $name = 'lainnya.pdf';
                    $config = [
                        'file_name'     => $name,
                        'allowed_types'   => 'pdf',
                        'upload_path'   => $upload_path
                    ];
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('berkas_lainnya')) {
                        $this->CalonGuru_m->update($calonguru->id_calonguru, ['berkas_lainnya' => 'berkas/' . $calonguru->id_calonguru . '_' . $calonguru->kd_rekrutmen . '/' . $name, 'nama_berkas_lainnya' => $name]);
                        $this->flashmsg('Berkas lainnya berhasil diunggah !', 'success');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        var_dump($error);
                        $this->flashmsg('Gagal, Coba lagi !', 'warning');
                        redirect('rekrutmen?kode=' . $calonguru->kd_rekrutmen . '&berkas=ya');
                        exit();
                    }
                } else {
                    $this->flashmsg('Format surat lamaran  harus .pdf   !', 'warning');
                    redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                    exit();
                }
            } else {
                redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
                exit();
            }
        } else {
            redirect('rekrutmen?kode=' . $this->POST('kd_rekrutmen') . '&berkas=ya');
            exit();
        }
    }
}
