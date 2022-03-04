<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <?= $this->session->flashdata('message');  ?>
                    <div class="text-center mb-3">
                        <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" height="150" class='mb-4'>
                        <h3>Ubah Password</h3>
                    </div>
                    <form action="<?= base_url('auth/changepassword') ?>" method="POST">
                        <div class="mb-3">
                            <label for="password1" class="form-label">Password baru</label>
                            <input type="password" class="form-control" id="password1" aria-describedby="password1" name="password1">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Konfirmasi password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>