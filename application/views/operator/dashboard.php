                    <div class="container-xl px-4 mt-5">
                        <!-- Custom page header alternative example-->
                        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                            <div class="me-4 mb-3 mb-sm-0">
                                <h1 class="mb-0">Dashboard</h1>
                                <div class="small">
                                    <span class="fw-500 text-primary"><?= date('l') ?></span>
                                    &middot; <?= date('F j, Y') ?> &middot;

                                    <span id="jam"></span> :
                                    <span id="menit"></span> :
                                    <span id="detik"></span>
                                </div>
                            </div>

                        </div>
                        <!-- Illustration dashboard card example-->
                        <div class="card card-waves mb-4 mt-5">
                            <div class="card-body p-5">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="text-primary">Selamat Datang, <?= $profil->nama_lengkap ?>!</h2>
                                        <p class="text-gray-700">Sistem Pendukung Keputusan Rekrutmen Guru TK Syailendra Palembang.</p>

                                    </div>
                                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5" src="<?= base_url() ?>assets/img/le.png" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <div class="card border-start-lg border-start-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-primary mb-1">Pengguna</div>
                                                <div class="h1"><?= $this->Pengguna_m->get_num_row(['role !=' => 3]) ?></div>

                                            </div>
                                            <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <div class="card border-start-lg border-start-secondary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-secondary mb-1">Calon Guru</div>
                                                <div class="h1"><?= $this->CalonGuru_m->get_num_row([]) ?></div>

                                            </div>
                                            <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <div class="card border-start-lg border-start-success h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">Rekrutmen</div>
                                                <div class="h1"><?= $this->Rekrutmen_m->get_num_row([]) ?></div>

                                            </div>
                                            <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <div class="card border-start-lg border-start-info  h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-info  mb-1">Kriteria</div>
                                                <div class="h1"><?= $this->Kriteria_m->get_num_row([]) ?></div>

                                            </div>
                                            <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>