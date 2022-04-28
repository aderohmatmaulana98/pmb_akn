<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
    </div>
    <section class="section">
        <div class="row mb-2">
        <?= $this->session->flashdata('message');  ?>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Pendaftar</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $pendaftar; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas1" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Diterima</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $diterima; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas2" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Tidak Lulus</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p><?= $tidak_lulus; ?></p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas3" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Belum Dinilai</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>
                                        <?= $belum_dinilai; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="canvas4" style="height:100px !important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 card shadow">
            <form action="<?= base_url('admin/aktivasi') ?>" method="POST" class="p-4">
                <div class="text-start" >
                    <label class="mb-3">Status PMB saat ini : <?php 
                    if ($pmb == 0) {
                        echo('Tidak Aktif');
                    }else {
                        echo('Aktif');
                    }
                    ?></label>
                    <select class="form-select" aria-label="Default select example" name="aktif" required>
                        <option value="" selected disabled>Pilih status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success m-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
</div>