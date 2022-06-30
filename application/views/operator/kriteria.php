<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="list"></i></div>
                        Kelola Data Kriteria
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
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary">Tambah Kriteria</button>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                        <th>Penilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($list_kriteria as $row) : ?>
                        <tr>
                            <td><?= $i++ ?> </td>
                            <td><?= $row->nama_kriteria ?> </td>
                            <td> <?= $row->bobot_vektor ?>%</td>
                            <td><?= $row->tipe ?> </td>
                            <td><?= $row->penilai ?> </td>
                            <td>

                                <a href="<?= base_url('operator/kriteria/' . $row->id_kriteria) ?>">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="edit"></i></button>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#delete-<?= $row->id_kriteria ?>" href="">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
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
                <h5 class="modal-title">Form Tambah Kriteria</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('operator/kriteria') ?>" method="Post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Kriteria</th>
                            <th>
                                <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Bobot Vektor </th>
                            <th>
                                <input type="number" min="1" class="form-control" name="bobot" placeholder="Masukkan Bobot Vektor Kriteria (%)" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <th>
                                <input name="tipe" type="radio" id="tipe1" value="Benefit" required />
                                <label for="tipe1">Benefit</label>
                                <input name="tipe" type="radio" id="tipe2" value="Cost" required />
                                <label for="tipe2">Cost</label>
                            </th>
                        </tr>
                        <tr>
                            <th>Penilai</th>
                            <th>
                                <input name="penilai" type="radio" id="penilai1" value="Operator" required />
                                <label for="penilai1">Operator</label>
                                <input name="penilai" type="radio" id="penilai2" value="Kepala Sekolah" required />
                                <label for="penilai2">Kepala Sekolah</label>
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
foreach ($list_kriteria as $row) : ?>
    <!-- Modal -->
    <div class="modal fade" id="delete-<?= $row->id_kriteria ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Kriteria?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('operator/kriteria') ?>" method="Post">
                    <input type="hidden" value="<?= $row->id_kriteria ?>" name="id_kriteria">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Kriteria</th>
                                <th>
                                    <?= $row->id_kriteria ?>
                                </th>
                            </tr>
                            <tr>
                                <th>Nama Kriteria</th>
                                <th>
                                    <?= $row->nama_kriteria ?>
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