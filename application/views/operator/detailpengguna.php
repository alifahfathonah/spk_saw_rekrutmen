<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="settings"></i></div>
                        Detail Pengguna - <?= $pengguna->nama_lengkap ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main content -->
<div class="container-xl px-4 mt-n10">
    <div class="container-fluid">
        <div class="row">
            <?= $this->session->flashdata('msg') ?>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <?php echo form_open_multipart('operator/pengguna'); ?>
                        <input type="hidden" name="email_x" value="<?= $pengguna->email ?>" />
                        <input type="hidden" name="id_pengguna" value="<?= $pengguna->id_pengguna ?>" />
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmail">Email</label>
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" value="<?= $pengguna->email ?>" />
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputnama_lengkap">Nama Lengkap</label>
                            <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?= $pengguna->nama_lengkap ?>" />
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputjk">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <input name="jk" type="radio" id="jk1" <?php if ($pengguna->jk == "Laki - Laki") {
                                                                            echo "checked";
                                                                        } ?> value="Laki - Laki" required />
                                <label for="jk1">Laki - Laki</label>
                                <input name="jk" type="radio" id="jk2" <?php if ($pengguna->jk == "Perempuan") {
                                                                            echo "checked";
                                                                        } ?> value="Perempuan" required />
                                <label for="jk2">Perempuan</label>
                            </div>
                        </div>


                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Tanggal Lahir</label>
                                <input class="form-control" id="inputBirthday" type="date" name="tanggal_lahir" placeholder="Enter your birthday" value="<?= $pengguna->tanggal_lahir ?>" />
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                                <input class="form-control" id="inputPhone" type="text" name="no_telp" placeholder="Enter your phone number" value="<?= $pengguna->no_telp ?>" />
                            </div>
                            <!-- Form Group (birthday)-->

                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputjk">Role</label>
                            <div class="col-sm-10">
                                <input name="role" type="radio" id="role1" <?php if ($pengguna->role == 1) {
                                                                                echo "checked";
                                                                            } ?> value="1" required />
                                <label for="role1">Admin</label>
                                <input name="role" type="radio" id="role2" <?php if ($pengguna->role == 2) {
                                                                                echo "checked";
                                                                            } ?> value="2" required />
                                <label for="role2">Kepala Sekolah</label>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <center>
                            <input type="submit" class="btn btn-primary" value="Simpan" name="edit">
                        </center>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-3">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <?php if ($pengguna->foto != 'foto/default.jpg') { ?>
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/assets/<?= $pengguna->foto ?>" alt="User profile picture" style="width: 180px; height: 180px">
                            <?php } else {
                            if ($pengguna->jk == "Laki - Laki") {
                            ?>
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/assets/foto/default-l.png" alt=" User profile picture" style="width: 180px; height: 180px">
                            <?php  } else { ?>

                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/assets/foto/default-p.png" alt=" User profile picture" style="width: 180px; height: 180px">
                            <?php  } ?>
                        <?php  } ?>
                        <hr>
                        <!-- Profile picture help block-->
                        <!-- Profile picture upload button-->

                        <button type="button" data-bs-toggle="modal" data-bs-target="#uploadfoto" class="btn btn-primary">Upload Foto</button>

                        <?php if ($pengguna->foto != 'foto/default.jpg' && $pengguna->foto != 'foto/default-l.jpg' && $pengguna->foto != 'foto/default-p.jpg') { ?>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#hapusfoto" class="btn btn-danger">Hapus Foto</button>

                        <?php } ?>
                    </div>
                </div>
                <div class="card mb-4 mb-xl-3">
                    <div class="card-header">Password</div>
                    <div class="card-body text-center">

                        <button type="button" data-bs-toggle="modal" data-bs-target="#ganti" class="btn btn-primary">Ganti Password</button>


                    </div>
                </div>

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Hapus Data Pengguna</div>
                    <div class="card-body text-center">

                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapusakun" class="btn btn-warning">Hapus Akun</button>


                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" id="uploadfoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Foto</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('operator/pengguna/') ?>
                <input type="hidden" name="id_pengguna" value="<?= $pengguna->id_pengguna ?>">

                <input type="file" name="foto" required>

            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="uploadfoto" value="Upload">

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hapusfoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Foto</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('operator/pengguna/') ?>
                <input type="hidden" name="id_pengguna" value="<?= $pengguna->id_pengguna ?>">
                <p style="color: red">foto akan diganti dengan foto default</p>
            </div>
            <div class="modal-footer ">
                <input type="submit" class="btn btn-primary" name="hapusfoto" value="Hapus">

                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="hapusakun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Akun</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('operator/pengguna/') ?>
                <input type="hidden" name="id_pengguna" value="<?= $pengguna->id_pengguna ?>">
                Apakah kamu yakin ingin menghapus pengguna ini ?
            </div>
            <div class="modal-footer ">
                <input type="submit" class="btn btn-primary" name="hapus" value="Hapus">

                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="ganti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ganti Password</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('operator/pengguna') ?>" method="Post">
                    <input type="hidden" name="id_pengguna" value="<?= $pengguna->id_pengguna ?>">

                    <div class="help-info" id="pesan2_ks"></div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pass1" id="pass1_ks" placeholder="Password baru" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="help-info" id="pesan3_ks"> </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pass2" id="pass2_ks" placeholder="Konfirmasi Password Baru" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="edit2" value="Simpan">

                <?php echo form_close() ?>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>