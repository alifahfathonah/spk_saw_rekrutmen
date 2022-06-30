<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa fa-user-plus"></i></div>
                        Data Rekrutmen
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <?= $this->session->flashdata('msg') ?>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Rekrutmen</th>
                        <th>Judul</th>
                        <th>Buka/Tutup</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($list_rekrutmen as $row) : ?>
                        <tr>
                            <td><?= $i++ ?> </td>
                            <td><?= $row->kd_rekrutmen ?> </td>
                            <td><?= $row->judul ?></td>
                            <td><?= $row->buka ?>/<?= $row->tutup ?></td>
                            <td>
                                <?php
                                if ($row->status == 0) {
                                    echo "draft";
                                } elseif ($row->status == 1) {
                                    echo "Tahap Pendaftaran";
                                } elseif ($row->status == 2) {
                                    echo "Menunggu Tahap Penilaian Dimulai";
                                } elseif ($row->status == 3) {
                                    echo "Tahap Penilaian";
                                } elseif ($row->status == 4) {
                                    echo "Cek Hasil Penilaian";
                                } elseif ($row->status == 5) {
                                    echo "Selesai";
                                }
                                ?>
                            </td>

                            <td>

                                <a href="<?= base_url('kepalasekolah/rekrutmen/' . $row->kd_rekrutmen) ?>">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="edit"></i></button>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Buat Rekrutmen Baru</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('kepalasekolah/rekrutmen') ?>" method="Post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Judul</th>
                            <th>
                                <input type="text" class="form-control" name="judul" required autofocus>
                            </th>
                        </tr>

                        <tr>
                            <th>Tanggal Buka Pendaftaran</th>
                            <th>
                                <input type="date" class="form-control" name="buka" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Tanggal Tutup Pendaftaran</th>
                            <th>
                                <input type="date" class="form-control" name="tutup" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Jumlah Guru yang dibutuhkan</th>
                            <th>
                                <input type="number" class="form-control" name="jumlah_guru" min="1" required autofocus>
                            </th>
                        </tr>

                    </table>

            </div>
            <div class="modal-footer">
                <input type="submit" class="btn bg-primary text-white" name="tambah" value="Tambah">
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>


<?php $i = 1;
foreach ($list_rekrutmen as $row) : ?>
    <!-- Modal -->
    <div class="modal fade" id="delete-<?= $i++ ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Pengguna?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('kepalasekolah/pengguna') ?>" method="Post">
                    <input type="hidden" value="<?= $row->email ?>" name="email">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Email</th>
                                <th>
                                    <?= $row->email ?>
                                </th>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>
                                    <?= $row->nama_lengkap ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary btn-block text-white " name="hapus" value="Hapus">
                    </div>
                    <?php echo form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>