<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Ubah password</h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-lg-6 card shadow p-3">
                <?= $this->session->flashdata('message');  ?>
                <form action="<?= base_url('user/change_password') ?>" method="POST">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password saat ini</label>
                        <input type="password" class="form-control" id="current_password" aria-describedby="current_password" name="current_password">
                        <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        <?= form_error('new_password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi password</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                        <?= form_error('konfirmasi_password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
</div>
</div>