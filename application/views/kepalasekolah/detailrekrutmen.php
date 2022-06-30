<?php if ($rekrutmen->status == 3) { ?>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-user-plus"></i></div>
                            Data Rekrutmen - <?= $rekrutmen->judul ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('msg') ?>

                <nav class="nav nav-borders">
                    <a class="nav-link 
                    <?php
                    if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'calonguru')) || empty($_GET['konten'])) {
                        echo "active ms-0";
                    }
                    ?> 
                    " href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=calonguru') ?>">Calon Guru</a>
                </nav>

                <hr>
                <?php
                if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'calonguru')) || empty($_GET['konten'])) { ?>
                    <?php
                    if (isset($_GET['id'])) {

                        if ($this->CalonGuru_m->get_num_row(['id_calonguru' => $_GET['id']]) == 0) {
                            redirect('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=calonguru');
                            exit;
                        }

                        $cg = $this->CalonGuru_m->get_row(['id_calonguru' => $_GET['id']]);
                        $pcg = $this->Pengguna_m->get_row(['email' => $cg->email]);
                    ?>

                        <nav class="nav nav-borders">
                            <a class="nav-link 
                        <?php
                        if ((isset($_GET['formnilai']) && ($_GET['formnilai'] == ''  || $_GET['formnilai'] == 'y')) || empty($_GET['formnilai'])) {
                            echo "active ms-0";
                        }
                        ?> 
                        " href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=calonguru&id=' . $_GET['id'] . '&formnilai=y') ?>">Nilai Calon Guru</a>
                            <a class="nav-link 
                        <?php
                        if (isset($_GET['formnilai']) && ($_GET['formnilai'] == 'n')) {
                            echo "active active ms-0";
                        }
                        ?> 
                    " href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=calonguru&id=' . $_GET['id'] . '&formnilai=n') ?>">Data Calon Guru</a>
                        </nav>
                        <hr>
                        <?php if ((isset($_GET['formnilai']) && ($_GET['formnilai'] == ''  || $_GET['formnilai'] == 'y')) || empty($_GET['formnilai'])) { ?>

                            <?= form_open_multipart('kepalasekolah/rekrutmen/') ?>
                            <input type="hidden" name="id_calonguru" required value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="kd_rekrutmen" required value="<?= $rekrutmen->kd_rekrutmen ?>">
                            <table class="table table-bordered ">
                                <?php foreach ($list_kriteria as $kriteria) : ?>
                                    <tr>
                                        <th style="width: 30%;"><?= $kriteria->nama_kriteria ?></th>
                                        <td>

                                            <?php if ($this->Penilaian_m->get_num_row(['id_kriteria' => $kriteria->id_kriteria, 'id_calonguru' => $_GET['id']]) == 0) { ?>
                                                <?php if ($kriteria->penilai == 'Kepala Sekolah') { ?>


                                                    <select class="form-control" required name="kriteria_<?= $kriteria->id_kriteria ?>">
                                                        <option value="">- Pilih -</option>
                                                        <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $kriteria->id_kriteria]); ?>
                                                        <?php foreach ($list_param as $row2) : ?>
                                                            <option value="<?= $row2->id_bobot ?>"><?= $row2->keterangan ?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                <?php } else { ?>
                                                    -
                                                <?php } ?>

                                            <?php    } else { ?>
                                                <?php if ($kriteria->penilai == 'Kepala Sekolah') { ?>
                                                    <?php $bobot = $this->Penilaian_m->get_row(['id_kriteria' => $kriteria->id_kriteria, 'id_calonguru' => $_GET['id']]) ?>
                                                    <select class="form-control" required name="kriteria_<?= $kriteria->id_kriteria ?>">
                                                        <option value="<?= $bobot->id_bobot ?>"><?= $this->Bobot_m->get_row(['id_bobot' => $bobot->id_bobot])->keterangan ?></option>
                                                        <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $kriteria->id_kriteria]); ?>
                                                        <?php foreach ($list_param as $row2) : ?>
                                                            <?php if ($bobot->id_bobot != $row2->id_bobot) { ?>
                                                                <option value="<?= $row2->id_bobot ?>"><?= $row2->keterangan ?></option>
                                                            <?php } ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php } else { ?>
                                                    <?php $bobot = $this->Penilaian_m->get_row(['id_kriteria' => $kriteria->id_kriteria, 'id_calonguru' => $_GET['id']]) ?>
                                                    <?= $this->Bobot_m->get_row(['id_bobot' => $bobot->id_bobot])->keterangan ?>
                                                <?php } ?>

                                            <?php } ?>



                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                            </table>

                            <input type="submit" class="btn bg-blue btn-block text-white " name="simpannilai" value="Simpan"> <br><br>
                            <?php echo form_close() ?>
                        <?php  } else { ?>
                            <h2>Data Profil</h2>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmail">Email</label>
                                <input type="email" id="inputEmail" name="email" class="form-control" style="background-color: white;" placeholder="Email" value="<?= $pcg->email ?>" readonly />
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputnama_lengkap">Nama Lengkap</label>
                                <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" style="background-color: white;" readonly value="<?= $pcg->nama_lengkap ?>" />
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputjk">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <?= $pcg->jk ?>
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Tanggal Lahir</label>
                                    <input class="form-control" id="inputBirthday" type="date" name="tanggal_lahir" style="background-color: white;" readonly value="<?= $pcg->tanggal_lahir ?>" />
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                                    <input class="form-control" id="inputPhone" type="text" name="no_telp" style="background-color: white;" readonly value="<?= $pcg->no_telp ?>" />
                                </div>


                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="inputPhone">Alamat</label>
                                <textarea readonly style="background-color: white;" class="form-control"><?= $pcg->alamat ?></textarea>

                            </div>
                            <hr>

                            <h2>Berkas Lamaran</h2>
                            <h3>Surat Lamaran : </h3>
                            <object data="<?= base_url($cg->surat_lamaran) ?>" type="application/pdf" width="100%" height="500">
                                <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('kepalasekolah/download1/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object>
                            <br><br>
                            <h3>Curriculum Vitae : </h3>
                            <object data="<?= base_url($cg->cv) ?>" type="application/pdf" width="100%" height="500">
                                <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object>
                            <br><br>
                            <h3>Ijazah Terakhir : </h3>
                            <object data="<?= base_url($cg->ijazah_terakhir) ?>" type="application/pdf" width="100%" height="500">
                                <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object>
                            <br><br>
                            <h3>KTP : </h3>
                            <object data="<?= base_url($cg->ktp) ?>" type="application/pdf" width="100%" height="500">
                                <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object>
                            <br><br>
                            <h3>Berkah Lainnya : </h3>
                            <object data="<?= base_url($cg->berkas_lainnya) ?>" type="application/pdf" width="100%" height="500">
                                <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                            </object>
                            <hr>

                            <a href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=calonguru') ?>">
                                <button type="button" class="btn bg-secondary text-white">
                                    <span class="btn-inner-text">Kembali</span>
                                </button>
                            </a>
                            <a href="<?= base_url('kepalasekolah/downloadberkas/' . $cg->id_calonguru) ?>">
                                <button type="button" class="btn bg-primary text-white">
                                    <span class="btn-inner-text">Download Berkas</span>
                                </button>
                            </a>
                        <?php } ?>


                    <?php } else {   ?> <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID Calon Guru</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nilai kepalasekolah</th>
                                    <th>Nilai Kepala Sekolah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;

                                $list_calon = $this->CalonGuru_m->get(['kd_rekrutmen' => $rekrutmen->kd_rekrutmen, 'status' => 1]);

                                $list_kriteria_a = $this->Kriteria_m->get(['penilai' => 'kepalasekolah']);
                                $list_kriteria_b = $this->Kriteria_m->get(['penilai' => 'Kepala Sekolah']);

                                foreach ($list_calon as $row) : ?>

                                    <?php $calonguru = $this->Pengguna_m->get_row(['email' => $row->email]); ?>
                                    <tr>
                                        <td><?= $row->id_calonguru ?> </td>
                                        <td><?= $calonguru->nama_lengkap ?></td>

                                        <td>
                                            <?php
                                            $xa = 0;

                                            foreach ($list_kriteria_a as $a) {
                                                if ($this->Penilaian_m->get_num_row(['id_calonguru' => $row->id_calonguru, 'id_kriteria' => $a->id_kriteria]) != 0) {
                                                    $xa++;
                                                }
                                            }
                                            ?>

                                            <?= $xa ?>/<?= sizeof($list_kriteria_a) ?> </td>
                                        <td>
                                            <?php
                                            $xb = 0;

                                            foreach ($list_kriteria_b as $b) {
                                                if ($this->Penilaian_m->get_num_row(['id_calonguru' => $row->id_calonguru, 'id_kriteria' => $b->id_kriteria]) != 0) {
                                                    $xb++;
                                                }
                                            }
                                            ?>
                                            <?= $xb ?> / <?= sizeof($list_kriteria_b) ?> </td>

                                        <td>

                                            <a href="<?= base_url('kepalasekolah/rekrutmen/' . $row->kd_rekrutmen . '?konten=calonguru&id=' . $row->id_calonguru) ?>">
                                                <button class="btn  btn-primary  me-2">Lihat Nilai</i></button>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php }  ?>
                <?php }  ?>



            </div>

        </div>
    </div>
<?php  } elseif ($rekrutmen->status == 4) { ?>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-user-plus"></i></div>
                            Data Rekrutmen - <?= $rekrutmen->judul ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('msg') ?>

                <nav class="nav nav-borders">
                    <a class="nav-link 
                    <?php
                    if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'hasilpenilaian')) || empty($_GET['konten'])) {
                        echo "active ms-0";
                    }
                    ?> 
                    " href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=hasilpenilaian') ?>">Hasil Penilaian</a>
                    <a class="nav-link 
                    <?php
                    if (isset($_GET['konten']) && ($_GET['konten'] == 'saw')) {
                        echo "active active ms-0";
                    }
                    ?> 
                    
                    " href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=saw') ?>">Detail Metode SAW</a>

                </nav>

                <hr>
                <?php
                if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'hasilpenilaian')) || empty($_GET['konten'])) { ?>
                    <?php
                    if (isset($_GET['id'])) {

                        if ($this->CalonGuru_m->get_num_row(['id_calonguru' => $_GET['id']]) == 0) {
                            redirect('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=calonguru');
                            exit;
                        }

                        $cg = $this->CalonGuru_m->get_row(['id_calonguru' => $_GET['id']]);
                        $pcg = $this->Pengguna_m->get_row(['email' => $cg->email]);
                    ?>

                        <h2>Data Profil</h2>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmail">Email</label>
                            <input type="email" id="inputEmail" name="email" class="form-control" style="background-color: white;" placeholder="Email" value="<?= $pcg->email ?>" readonly />
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputnama_lengkap">Nama Lengkap</label>
                            <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" style="background-color: white;" readonly value="<?= $pcg->nama_lengkap ?>" />
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputjk">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <?= $pcg->jk ?>
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Tanggal Lahir</label>
                                <input class="form-control" id="inputBirthday" type="date" name="tanggal_lahir" style="background-color: white;" readonly value="<?= $pcg->tanggal_lahir ?>" />
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                                <input class="form-control" id="inputPhone" type="text" name="no_telp" style="background-color: white;" readonly value="<?= $pcg->no_telp ?>" />
                            </div>


                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputPhone">Alamat</label>
                            <textarea readonly style="background-color: white;" class="form-control"><?= $pcg->alamat ?></textarea>

                        </div>
                        <hr>

                        <h2>Berkas Lamaran</h2>
                        <h3>Surat Lamaran : </h3>
                        <object data="<?= base_url($cg->surat_lamaran) ?>" type="application/pdf" width="100%" height="500">
                            <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('kepalasekolah/download1/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                        </object>
                        <br><br>
                        <h3>Curriculum Vitae : </h3>
                        <object data="<?= base_url($cg->cv) ?>" type="application/pdf" width="100%" height="500">
                            <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                        </object>
                        <br><br>
                        <h3>Ijazah Terakhir : </h3>
                        <object data="<?= base_url($cg->ijazah_terakhir) ?>" type="application/pdf" width="100%" height="500">
                            <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                        </object>
                        <br><br>
                        <h3>KTP : </h3>
                        <object data="<?= base_url($cg->ktp) ?>" type="application/pdf" width="100%" height="500">
                            <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                        </object>
                        <br><br>
                        <h3>Berkah Lainnya : </h3>
                        <object data="<?= base_url($cg->berkas_lainnya) ?>" type="application/pdf" width="100%" height="500">
                            <p>Plugin penampil PDF tidak tersedia di browser Anda, <a href="<?= base_url('admin/download2/' . $cg->id_calonguru) ?>">Silahkan klik disini untuk mendownload file.</a></p>
                        </object>
                        <hr>

                        <a href="<?= base_url('kepalasekolah/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=hasilpenilaian') ?>">
                            <button type="button" class="btn bg-secondary text-white">
                                <span class="btn-inner-text">Kembali</span>
                            </button>
                        </a>
                        <a href="<?= base_url('kepalasekolah/downloadberkas/' . $cg->id_calonguru) ?>">
                            <button type="button" class="btn bg-primary text-white">
                                <span class="btn-inner-text">Download Berkas</span>
                            </button>
                        </a>

                    <?php } else {   ?>

                        <?php
                        $saw = $this->Penilaian_m->saw($rekrutmen->kd_rekrutmen);

                        ?>


                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>ID Calon Guru</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;

                                $list_calon = $this->CalonGuru_m->get(['kd_rekrutmen' => $rekrutmen->kd_rekrutmen, 'status' => 1]);

                                $list_kriteria_a = $this->Kriteria_m->get(['penilai' => 'kepalasekolah']);
                                $list_kriteria_b = $this->Kriteria_m->get(['penilai' => 'Kepala Sekolah']);

                                foreach ($saw['hasil_akhir'] as $row) : ?>

                                    <?php $calonguru = $this->CalonGuru_m->get_row(['id_calonguru' => $row['id_calonguru']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $calonguru->email]); ?>

                                    <?php if ($i <= $rekrutmen->jumlah_guru) { ?>
                                        <tr style="background-color:chartreuse; ">
                                        <?php } else { ?>
                                        <tr>
                                        <?php } ?>

                                        <th><?= $i++ ?></th>
                                        <td><?= $calonguru->id_calonguru ?> </td>
                                        <td><a style="text-decoration: underline;text-decoration-color:black;" href="<?= base_url('kepalasekolah/rekrutmen/' . $calonguru->kd_rekrutmen . '?konten=hasilpenilaian&id=' . $row['id_calonguru']) ?>">
                                                <?= $pcg->nama_lengkap ?></a></td>

                                        <th><?= number_format($row['nilai_akhir'], 3) ?></th>


                                        </tr>
                                    <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php }  ?>
                <?php } elseif (isset($_GET['konten']) && ($_GET['konten'] == 'saw')) { ?>
                    <?php
                    $saw = $this->Penilaian_m->saw($rekrutmen->kd_rekrutmen);

                    ?>
                    <h3>1. Nilai Awal</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Calon Guru </th>

                                    <?php $i = 1;
                                    foreach ($list_kriteria as $row) : ?>
                                        <th><?= $row->nama_kriteria ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['nilai_awal'] as $row) : ?>
                                    <?php $calonguru = $this->CalonGuru_m->get_row(['id_calonguru' => $row['id_calonguru']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $calonguru->email]); ?>
                                    <tr>
                                        <td><?= $pcg->nama_lengkap ?> </td>

                                        <?php
                                        for ($i = 0; $i < sizeof($row['nilai']); $i++) {
                                            echo '<td>' .  $row['nilai'][$i] . '</td>  ';
                                        }
                                        ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <h3>2. Normalisasi Matrik R</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama lokasi </th>
                                    <?php $i = 1;
                                    foreach ($list_kriteria as $row) : ?>
                                        <th><?= $row->nama_kriteria ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['matrik_r']  as $row) : ?>
                                    <?php $calonguru = $this->CalonGuru_m->get_row(['id_calonguru' => $row['id_calonguru']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $calonguru->email]); ?>

                                    <tr>
                                        <td><?= $pcg->nama_lengkap ?> </td>
                                        <?php
                                        for ($i = 0; $i < sizeof($row['nilai']); $i++) {
                                            echo '<td>' .  $row['nilai'][$i] . '</td>  ';
                                        }
                                        ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h3>3. Hasil Akhir </h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Lokasi </th>
                                    <th>Nama Lokasi </th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['hasil'] as $row) : ?>
                                    <?php $calonguru = $this->CalonGuru_m->get_row(['id_calonguru' => $row['id_calonguru']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $calonguru->email]); ?>
                                    <tr>

                                        <td><?= $calonguru->id_calonguru ?> </td>
                                        <td><?= $pcg->nama_lengkap ?> </td>
                                        <td><?= $row['nilai_akhir'] ?> </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <h3>4. Perangkingan</h3>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>ID Lokasi </th>
                                    <th>Nama Lokasi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['hasil_akhir'] as $row) : ?>
                                    <?php $calonguru = $this->CalonGuru_m->get_row(['id_calonguru' => $row['id_calonguru']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $calonguru->email]); ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $calonguru->id_calonguru ?> </td>
                                        <td><?= $pcg->nama_lengkap ?> </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php }  ?>



            </div>

        </div>
    </div>
<?php  } elseif ($rekrutmen->status == 5) { ?>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-user-plus"></i></div>
                            Data Rekrutmen - <?= $rekrutmen->judul ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-body">
                <?= $this->session->flashdata('msg') ?>

                <nav class="nav nav-borders">
                    <a class="nav-link 
                    <?php
                    if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'laporan')) || empty($_GET['konten'])) {
                        echo "active ms-0";
                    }
                    ?> 
                    " href="<?= base_url('operator/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=laporan') ?>">Laporan</a>


                </nav>

                <hr>
                <?php
                if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'laporan')) || empty($_GET['konten'])) { ?>
                    <?php
                    if (isset($_GET['id'])) {

                        if ($this->CalonGuru_m->get_num_row(['id_calonguru' => $_GET['id']]) == 0) {
                            redirect('operator/rekrutmen/' . $rekrutmen->kd_rekrutmen . '?konten=laporan');
                            exit;
                        }

                        $cg = $this->CalonGuru_m->get_row(['id_calonguru' => $_GET['id']]);
                        $pcg = $this->Pengguna_m->get_row(['email' => $cg->email]);
                    ?>

                        <h2>Data Profil</h2>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmail">Email</label>
                            <input type="email" id="inputEmail" name="email" class="form-control" style="background-color: white;" placeholder="Email" value="<?= $pcg->email ?>" readonly />
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputnama_lengkap">Nama Lengkap</label>
                            <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" style="background-color: white;" readonly value="<?= $pcg->nama_lengkap ?>" />
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputjk">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <?= $pcg->jk ?>
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Tanggal Lahir</label>
                                <input class="form-control" id="inputBirthday" type="date" name="tanggal_lahir" style="background-color: white;" readonly value="<?= $pcg->tanggal_lahir ?>" />
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                                <input class="form-control" id="inputPhone" type="text" name="no_telp" style="background-color: white;" readonly value="<?= $pcg->no_telp ?>" />
                            </div>


                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputPhone">Alamat</label>
                            <textarea readonly style="background-color: white;" class="form-control"><?= $pcg->alamat ?></textarea>

                        </div>
                        <hr>

                         

                    <?php }elseif(isset($_GET['detail'])){ ?>

                        <?php
                        $saw = $this->DLaporan_m->get(['id_laporan' => $_GET['detail']]);

                        ?>


                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Presentase</th> 
                                    <th>Nilai </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;

                               
                                foreach ($saw as $row) : ?>
                              
                                 
                                        <tr>
                                    
                                        <td><?= $row->kriteria ?> </td> 
                                        <td><?= $row->presentase ?>% </td> 
                                        <td><?= $row->nilai ?> </td> 


                                        </tr>
                                    <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php } else {   ?>

                        <?php
                        $saw = $this->Laporan_m->get(['kd_rekrutmen' => $rekrutmen->kd_rekrutmen]);

                        ?>


                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>ID Calon Guru</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;

                               
                                foreach ($saw as $row) : ?>

                                    <?php $calonguru = $this->CalonGuru_m->get_row(['id_calonguru' => $row->id_calonguru]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $calonguru->email]); ?>

                                    <?php if ($i <= $rekrutmen->jumlah_guru) { ?>
                                        <tr style="background-color:chartreuse; ">
                                        <?php } else { ?>
                                        <tr>
                                        <?php } ?>

                                        <th><?= $i++ ?></th>
                                        <td><?= $calonguru->id_calonguru ?> </td>
                                        <td><a style="text-decoration: underline;text-decoration-color:black;" href="<?= base_url('kepalasekolah/rekrutmen/' . $calonguru->kd_rekrutmen . '?konten=laporan&id=' . $row->id_calonguru) ?>">
                                                <?= $pcg->nama_lengkap ?></a></td>

                                        <th><a style="text-decoration: underline;text-decoration-color:black;" href="<?= base_url('kepalasekolah/rekrutmen/' . $calonguru->kd_rekrutmen . '?konten=laporan&detail=' . $row->id_laporan) ?>"><?= number_format($row->nilai_akhir, 3) ?></a></th>


                                        </tr>
                                    <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php }  ?>
                   <?php }  ?>



            </div>

        </div>
    </div>
<?php  }  ?>