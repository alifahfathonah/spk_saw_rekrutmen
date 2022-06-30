<?php
if (empty($_GET['kode'])) { ?>
    <section class="bg-light py-10">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-left">
                <h1 style="font-size: 40px">Daftar Rekrutmen</h1>
            </div>


            <?php
            foreach ($list_rekrutmen as $row) : ?>
                <a class="card post-preview post-preview-featured lift mb-5" href="<?= base_url('rekrutmen?kode=' . $row->kd_rekrutmen) ?>" data-aos="fade-right">
                    <div class="row no-gutters">
                        <div class="col-lg-3">
                            <div class="post-preview-featured-img" style='background-image: url("<?= base_url() ?>/assets/img/guru.png")'></div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card-body">

                                <div class="py-2">
                                    <h5 class="card-title"><?= $row->judul ?></h5>
                                    <p class="card-text">Keterangan : <br> <?= $row->keterangan ?> </p>
                                    <b><?= date('d/m/Y', strtotime($row->buka)) ?> - <?= date('d/m/Y', strtotime($row->tutup)) ?></b>

                                </div>
                                <hr />
                                <div class="post-preview-meta  d-flex align-items-center justify-content-between">
                                    <div class="post-preview-meta">
                                        <img class="post-preview-meta-img" src="<?= base_url() ?>assets/<?= $this->Pengguna_m->get_row(['email' => $row->email])->foto ?>" />
                                        <div class="post-preview-meta-details">
                                            <div class="post-preview-meta-details-name"><?= $this->Pengguna_m->get_row(['email' => $row->email])->nama_lengkap ?></div>
                                            <div class="post-preview-meta-details-date"><?= date('d-m-Y', strtotime($row->tgl_buat)) ?></div>
                                        </div>
                                    </div>
                                    <div class="small text-red">Lihat Selengkapnya</div>
                                </div>

                                </span>
                            </div>
                        </div>
                    </div>
                </a>

            <?php endforeach; ?>
        </div>
    </section>

<?php  } else {

    if ($this->Rekrutmen_m->get_num_row(['kd_rekrutmen' => $_GET['kode']]) == 0) {
        redirect('rekrutmen');
        exit;
    } else {

        $rekrutmen = $this->Rekrutmen_m->get_row(['kd_rekrutmen' => $_GET['kode']]);
        $pengguna =  $this->Pengguna_m->get_row(['email' => $rekrutmen->email]);
    }
?>

    <?php if ($ceklog == 1) { ?>

        <section class="bg-white py-15">
            <div class="container"><?= $this->session->flashdata('msg') ?>
                <div class="row justify-content-center">

                    <?php if (isset($_GET['berkas']) && $_GET['berkas'] == 'ya') { ?>


                        <div class="col-lg-8 col-xl-8">
                            <div class="card-body">
                                <?php if ($this->CalonGuru_m->get_num_row(['email' => $email, 'kd_rekrutmen' => $rekrutmen->kd_rekrutmen]) == 0) { ?>
                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-6 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Surat Lamaran</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#suratlamaran">Unggah</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-6 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Curriculum Vitae</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#cv">Unggah</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-6 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Ijazah Terakhir</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#ijazah_terakhir">Unggah</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-6 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">KTP</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf .jpg .png</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#ktp">Unggah</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-6 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Berkas Lainnya (Optional)</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#berkas_lainnya">Unggah</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else {
                                    $berkas = $this->CalonGuru_m->get_row(['email' => $email, 'kd_rekrutmen' => $rekrutmen->kd_rekrutmen]);
                                ?>
                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-4 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Surat Lamaran</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->surat_lamaran != NULL) { ?>
                                                            <center>
                                                                <p class="card-text text-gray-500"><i><a href="<?= base_url() . '/' . $berkas->surat_lamaran ?>" target="_blank"><?= $berkas->nama_suratlamaran ?></a></i></p>
                                                            </center>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->surat_lamaran == NULL) { ?>
                                                            <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#suratlamaran">Unggah</a></div>
                                                        <?php } else {  ?>
                                                            <div class="text-center"><a class="btn btn-secondary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#suratlamaran">Ubah</a></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-4 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Curriculum Vitae</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->cv != NULL) { ?>
                                                            <center>
                                                                <p class="card-text text-gray-500"><i><a href="<?= base_url() . '/' . $berkas->cv ?>" target="_blank"><?= $berkas->nama_cv ?></a></i></p>
                                                            </center>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->cv == NULL) { ?>
                                                            <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#cv">Unggah</a></div>
                                                        <?php } else {  ?>
                                                            <div class="text-center"><a class="btn btn-secondary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#cv">Ubah</a></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-4 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Ijazah Terakhir</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->ijazah_terakhir != NULL) { ?>
                                                            <center>
                                                                <p class="card-text text-gray-500"><i><a href="<?= base_url() . '/' . $berkas->ijazah_terakhir ?>" target="_blank"><?= $berkas->nama_ijazah  ?></a></i></p>
                                                            </center>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->ijazah_terakhir == NULL) { ?>
                                                            <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#ijazah_terakhir">Unggah</a></div>
                                                        <?php } else {  ?>
                                                            <div class="text-center"><a class="btn btn-secondary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#ijazah_terakhir">Ubah</a></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-4 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">KTP</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf .jpg .png </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->ktp != NULL) { ?>
                                                            <center>
                                                                <p class="card-text text-gray-500"><i><a href="<?= base_url() . '/' . $berkas->ktp ?>" target="_blank"><?= $berkas->nama_ktp  ?></a></i></p>
                                                            </center>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->ktp == NULL) { ?>
                                                            <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#ktp">Unggah</a></div>
                                                        <?php } else {  ?>
                                                            <div class="text-center"><a class="btn btn-secondary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#ktp">Ubah</a></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-faq mb-2 " id="authAccordion" data-aos="fade-right">
                                        <div class="card border-bottom">
                                            <div class="card-body">

                                                <div class="row align-items-center">

                                                    <div class="col-md-4 col-xl-6 mb-1">
                                                        <div class="mr-2">
                                                            <h5 class="mb-2">Berkas Lainnya (Optional)</h5>
                                                            <p class="card-text text-gray-500">Format file .pdf </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 col-xl-3 mb-1 mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->berkas_lainnya != NULL) { ?>
                                                            <center>
                                                                <p class="card-text text-gray-500"><i><a href="<?= base_url() . '/' . $berkas->berkas_lainnya ?>" target="_blank"><?= $berkas->nama_berkas_lainnya  ?></a></i></p>
                                                            </center>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3 mb-1  mt-2" data-aos="fade-down">
                                                        <?php if ($berkas->berkas_lainnya == NULL) { ?>
                                                            <div class="text-center"><a class="btn btn-primary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#berkas_lainnya">Unggah</a></div>
                                                        <?php } else {  ?>
                                                            <div class="text-center"><a class="btn btn-secondary btn-marketing rounded-pill" href="#" data-toggle="modal" data-target="#berkas_lainnya">Ubah</a></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <center>
                                    <a class="btn btn-primary btn-marketing rounded-pill lift lift-sm mt-3" href="<?= base_url('rekrutmen?kode=' . $_GET['kode']) ?>"><i class="fas fa-arrow-left ml-1"></i>Kembali</a>
                                </center>
                            </div>
                        </div>

                        <div class="modal fade" id="suratlamaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Unggah Surat Lamaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?= form_open_multipart('rekrutmen/unggah/') ?>
                                    <input type="hidden" name="kd_rekrutmen" value="<?= $rekrutmen->kd_rekrutmen ?>">
                                    <div class="modal-body">
                                        <p class="text-black"><i>Format file .pdf </i></p>
                                        <input type="file" name="suratlamaran" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="unggah1" value="Unggah">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="cv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Unggah Curriculum Vitae</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?= form_open_multipart('rekrutmen/unggah/') ?>
                                    <input type="hidden" name="kd_rekrutmen" value="<?= $rekrutmen->kd_rekrutmen ?>">
                                    <div class="modal-body">
                                        <p class="text-black"><i>Format file .pdf </i></p>
                                        <input type="file" name="cv" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="unggah2" value="Unggah">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="ijazah_terakhir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Unggah Ijazah Terakhir</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?= form_open_multipart('rekrutmen/unggah/') ?>
                                    <input type="hidden" name="kd_rekrutmen" value="<?= $rekrutmen->kd_rekrutmen ?>">
                                    <div class="modal-body">
                                        <p class="text-black"><i>Format file .pdf </i></p>
                                        <input type="file" name="ijazah_terakhir" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="unggah3" value="Unggah">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="ktp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Unggah KTP</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?= form_open_multipart('rekrutmen/unggah/') ?>
                                    <input type="hidden" name="kd_rekrutmen" value="<?= $rekrutmen->kd_rekrutmen ?>">
                                    <div class="modal-body">
                                        <p class="text-black"><i>Format file .pdf .jpg .png</i></p>
                                        <input type="file" name="ktp" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="unggah4" value="Unggah">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="berkas_lainnya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Unggah Berkas Lainnya (Optional)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <?= form_open_multipart('rekrutmen/unggah/') ?>
                                    <input type="hidden" name="kd_rekrutmen" value="<?= $rekrutmen->kd_rekrutmen ?>">
                                    <div class="modal-body">
                                        <p class="text-black"><i>Format file .pdf </i></p>
                                        <input type="file" name="berkas_lainnya" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" name="unggah5" value="Unggah">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class="col-lg-8 col-xl-8">
                            <div class="single-post">
                                <h1><?= $rekrutmen->judul ?></h1>
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="single-post-meta mr-4">
                                        <img class="single-post-meta-img" src="<?= base_url() ?>assets/<?= $pengguna->foto ?>" />
                                        <div class="single-post-meta-details">
                                            <div class="single-post-meta-details-name"><?= $pengguna->nama_lengkap ?></div>
                                            <div class="single-post-meta-details-date"><?= date('d-m-Y', strtotime($rekrutmen->tgl_buat)) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-post-text my-5">
                                    <b>Keterangan : </b>
                                    <?= $rekrutmen->keterangan ?>
                                    <br>

                                    <b>Persyaratan : </b>
                                    <?= $rekrutmen->persyaratan ?>
                                    <hr class="my-5" />

                                </div>
                            </div>
                        </div>
                    <?php } ?>




                    <?php
                    $cek = 0;
                    if ($profil->email != NULL) {
                        $cek++;
                    }
                    if ($profil->nama_lengkap != NULL) {
                        $cek++;
                    }
                    if ($profil->no_telp != NULL) {
                        $cek++;
                    }
                    if ($profil->tanggal_lahir != NULL) {
                        $cek++;
                    }

                    if ($profil->jk != NULL) {
                        $cek++;
                    }
                    if ($profil->alamat != NULL) {
                        $cek++;
                    }

                    $prog = $cek / 6;
                    ?>
                    <div class="col-lg-4 col-xl-4">
                        <div class="card mb-3">
                            <div class="card-header">Data Profil</div>
                            <div class="card-body text-center">

                                <div class="progress mb-2">
                                    <div class="progress-bar bg-success text-black" role="progressbar" style="width: <?= $prog * 100 ?>%" aria-valuenow="<?= $prog * 100 ?>" aria-valuemin="0" aria-valuemax="100"><?= number_format($prog * 100, 0) ?>%</div>
                                </div>
                                <?php if ($cek < 6) { ?>
                                    <a href="<?= base_url('profil') ?>" class="mt-2">Lengkapi Profil</a>
                                <?php }  ?>
                            </div>
                        </div>
                        <?php
                        $cek2 = 0;
                        if ($this->CalonGuru_m->get_num_row(['email' => $email, 'kd_rekrutmen' => $rekrutmen->kd_rekrutmen]) == 0) {
                            $cek2  == 0;
                        } else {
                            $berkas = $this->CalonGuru_m->get_row(['email' => $email, 'kd_rekrutmen' => $rekrutmen->kd_rekrutmen]);
                            if ($berkas->surat_lamaran != NULL) {
                                $cek2++;
                            }
                            if ($berkas->ktp != NULL) {
                                $cek2++;
                            }
                            if ($berkas->cv != NULL) {
                                $cek2++;
                            }
                            if ($berkas->ijazah_terakhir != NULL) {
                                $cek2++;
                            }
                        }

                        $prog = $cek2 / 4;



                        ?>
                        <div class="card mb-5">
                            <div class="card-header">Berkas Lamaran</div>
                            <div class="card-body text-center">

                                <div class="progress mb-2">
                                    <div class="progress-bar bg-success text-black" role="progressbar" style="width: <?= $prog * 100 ?>%" aria-valuenow="<?= $prog * 100 ?>" aria-valuemin="0" aria-valuemax="100"><?= number_format($prog * 100, 0) ?>%</div>
                                </div>
                                <?php if ($cek2 < 4) { ?>
                                    <a href="<?= base_url('rekrutmen?kode=' . $rekrutmen->kd_rekrutmen . '&berkas=ya') ?>" class="mt-2">Lengkapi Berkas</a>
                                <?php }  ?>
                                <hr>
                                <?php
                                if ($this->CalonGuru_m->get_num_row(['email' => $email, 'kd_rekrutmen' => $rekrutmen->kd_rekrutmen]) == 0) { ?>
                                    <a class="btn btn-primary btn-marketing rounded-pill lift lift-sm mt-2" href="#" data-toggle="modal" data-target="#kirim">Kirim Lamaran<i class="fas fa-paper-plane ml-1"></i></a>
                                    <?php } else {
                                    $berkas = $this->CalonGuru_m->get_row(['email' => $email, 'kd_rekrutmen' => $rekrutmen->kd_rekrutmen]);
                                    if ($berkas->status == 1) { ?>
                                        <center><b class="text-green">Lamaran anda telah terkirim.</b></center>
                                    <?php } else { ?>
                                        <a class="btn btn-primary btn-marketing rounded-pill lift lift-sm mt-2" href="#" data-toggle="modal" data-target="#kirim">Kirim Lamaran<i class="fas fa-paper-plane ml-1"></i></a>
                                    <?php } ?>

                                <?php } ?>

                            </div>
                        </div>

                    </div>

                    <div class="modal fade" id="kirim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kirim Lamaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <?= form_open_multipart('rekrutmen/kirim/') ?>
                                <input type="hidden" name="kd_rekrutmen" value="<?= $rekrutmen->kd_rekrutmen ?>">
                                <div class="modal-body">
                                    <p class=" <?php if ($cek <  6) {
                                                    echo 'text-red';
                                                } else {
                                                    echo 'text-green';
                                                } ?> "><i>Data Profil (<?= $cek ?>/6)</i></p>
                                    <p class=" <?php if ($cek2 <  4) {
                                                    echo 'text-red';
                                                } else {
                                                    echo 'text-green';
                                                } ?> "><i>Berkas Lamaran (<?= $cek2 ?>/4)</i></p>
                                </div>
                                <div class="modal-footer">
                                    <?php if ($cek == 6 && $cek2 == 4) { ?>
                                        <input type="submit" class="btn btn-primary" name="kirim" value="Kirim">
                                    <?php } ?>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    <?php } else { ?>
        <section class="bg-white py-15">
            <div class="container"><?= $this->session->flashdata('msg') ?>
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="single-post">
                            <h1><?= $rekrutmen->judul ?></h1>
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <div class="single-post-meta mr-4">
                                    <img class="single-post-meta-img" src="<?= base_url() ?>assets/<?= $pengguna->foto ?>" />
                                    <div class="single-post-meta-details">
                                        <div class="single-post-meta-details-name"><?= $pengguna->nama_lengkap ?></div>
                                        <div class="single-post-meta-details-date"><?= date('d-m-Y', strtotime($rekrutmen->tgl_buat)) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-post-text my-5">
                                <b>Keterangan : </b>
                                <?= $rekrutmen->keterangan ?>
                                <br>

                                <b>Persyaratan : </b>
                                <?= $rekrutmen->persyaratan ?>
                                <hr class="my-5" />
                                <center>
                                    <a class="btn btn-primary btn-marketing rounded-pill lift lift-sm" href="<?= base_url('daftar?kode=' . $_GET['kode']) ?>">Daftar Sekarang<i class="fas fa-arrow-right ml-1"></i></a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

<?php } ?>