<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title ?></h3>
    </div>
    <?= $this->session->flashdata('message');  ?>
    <section class="section">
        <div class="row ">
            <div class="my-4" align="center">

                <div class="card shadow mt-0 col-lg-12">
                    <div class="col-md-auto">
                        <div class="col-lg-3 mb-3 mt-3">
                            <img src="<?= base_url('assets/admin_panel/assets/images/icon/WAIT.svg'); ?>" width="200" height="200" alt="Lulus">
                        </div>
                        <div>

                            <div class="mb-3 mt-3">
                                <h2 style="color:darkorange">Bukti bayar berhasil disimpan <img src="<?= base_url('assets/admin_panel/assets/images/icon/ceklis.png'); ?>" width="40" height="48" alt="Ceklis"> </h2>
                                <h3>Bukti bayar masih dalam proses verifikasi oleh admin, silahkan periksa website
                                    secara
                                    berkala untuk ke tahap isi formulir.</h3>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </section>
</div>
</div>