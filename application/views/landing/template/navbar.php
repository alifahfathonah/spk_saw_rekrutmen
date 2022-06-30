                    <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light fixed-top" style="padding-bottom: 5px;padding-top: 5px;">
                        <div class="container">


                            <a class=" text-primary" href="<?= base_url() ?>">
                                <img src="<?= base_url('assets/img/logo-event.png') ?>" style="width: 80px">
                            </a>

                            <div>

                                <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>

                                <?php if ($this->session->userdata('email_peserta')) { ?>


                                    <div class="btn-group dropleft">

                                    </div>

                                    <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                                        <div class="icon-stack bg-primary-soft text-primary">
                                            <i class="fa fa-user-circle text-primary"></i>
                                        </div>
                                    </button>
                                <?php } ?>
                            </div>



                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-0" style="padding-bottom: 5px; padding-top: 5px">
                                    <li class="nav-item <?php if ($this->uri->segment(1) == '') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url() ?>">Beranda </a></li>

                                    <li class="nav-item <?php if ($this->uri->segment(1) == '') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url('#visi') ?>">Visi</a></li>

                                    <li class="nav-item <?php if ($this->uri->segment(1) == '') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url('#misi') ?>">Misi</a></li>
                                    <li class="nav-item <?php if ($this->uri->segment(1) == '') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url('#tujuan') ?>">Tujuan</a></li>

                                    <li class="nav-item <?php if ($this->uri->segment(1) == '') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url('#galeri') ?>">Galeri </a></li>

                                    <li class="nav-item <?php if ($this->uri->segment(1) == 'rekrutmen') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url('rekrutmen') ?>">Rekrutmen </a></li>





                                    <?php if ($this->session->userdata('email') && $this->session->userdata('id_role') == 3) { ?>


                                    <li class="nav-item <?php if ($this->uri->segment(1) == 'lamaran') {
                                                            echo 'active';
                                                        } ?>"><a class="nav-link" href="<?= base_url('lamaran') ?>">Lamaran Saya   </a></li>

                                        <li class="nav-item ml-3 dropdown no-caret d-none d-lg-block ">
                                            <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                <div class="icon-stack bg-primary-soft text-primary">
                                                    <i class="fa fa-user-circle text-primary"></i>
                                                </div> <i class="fas fa-chevron-right dropdown-arrow"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="navbarDropdownDocs">


                                                <a class="dropdown-item py-3" href="<?= base_url('profil') ?>">
                                                    <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="fas text-primary fa-user"></i></div>
                                                    <div>
                                                        <div class="small text-black-500">Profil Saya</div>
                                                    </div>
                                                </a>
                                                <div class="dropdown-divider m-0"></div>
                                                <a class="dropdown-item py-3" href="<?= base_url('keluar') ?>">
                                                    <div class="icon-stack bg-primary-soft text-primary mr-4"><i class="fas text-primary fa-power-off"></i></div>
                                                    <div>
                                                        <div class="small text-black-500">Keluar</div>
                                                    </div>
                                                </a>

                                            </div>

                                        </li>

                                    <?php } else {  ?>


                                        <div class="row ">
                                            <div class="col-6">
                                                <a class="btn-primary btn btn-block rounded-pill px-4 ml-lg-4" href="<?= base_url('masuk') ?>">Masuk</a>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn-secondary btn btn-block rounded-pill px-4" href="<?= base_url('daftar') ?>">Daftar</a>
                                            </div>
                                        </div>

                                    <?php }  ?>

                                </ul>
                            </div>

                            <?php if ($this->session->userdata('email')) { ?>
                                <div class="collapse navbar-collapse " id="navbarSupportedContent2">
                                    <ul class="navbar-nav" style="padding-bottom: 5px; padding-top: 5px">


                                        <?php if ($this->session->userdata('email')) { ?>





                                            <li class="nav-item d-lg-none d-xl-none"><a class="nav-link" href="<?= base_url('profil') ?>">Profil Saya </a></li>
                                            <li class="nav-item d-lg-none d-xl-none"><a class="nav-link" href="<?= base_url('keluar') ?>">Keluar </a></li>


                                        <?php } else { ?>

                                            <div class="row ">
                                                <div class="col-6">
                                                    <a class="btn-secondary btn btn-block rounded-pill px-4 ml-lg-4" href="<?= base_url('masuk') ?>">Masuk</a>
                                                </div>
                                                <div class="col-6">
                                                    <a class="btn-primary btn btn-block rounded-pill px-4" href="<?= base_url('daftar') ?>">Daftar</a>
                                                </div>
                                            </div>
                                        <?php }  ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </nav>

                    <a href="" target="_blank"><img src="<?= base_url('assets/img/wa.png') ?>" class="fixedbutton"></a>