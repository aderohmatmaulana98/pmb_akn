<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Bukti bayar</h3>
    </div>
    <section class="section">
        <div class="row mb-12 mt-3">
            <div class="col-lg-8 card shadow p-3">
                <?= $this->session->flashdata('message');  ?>
                <form action="<?= base_url('user/aksi_bayar') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="no_slip">Kode Transaksi</label>
                        <input type="text" id="no_slip" class="form-control" value="<?= set_value('no_slip') ?>" name="no_slip" required>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_bayar">Bukti Bayar</label>
                        </br>
                        <input type="file" placeholder="Bukti bayar" id="bukti_bayar" name="bukti_bayar" required><br>
                        <small class="text-muted">*Upload dalam format JPG/JPEG/PNG</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
</div>
</div>