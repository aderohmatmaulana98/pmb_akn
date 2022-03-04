        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4" style="background-color: rgba(231, 224, 255, 0.8);">
                        <div class="card-body">
                            <?= $this->session->flashdata('message');  ?>
                            <div class="text-center mb-5">
                                <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" height="100" class='mb-4'>
                                <h3 style="color: black;">Login</h3>
                                <p style="color: black;">Silahkan login untuk melanjutkan.</p>
                            </div>
                            <form action="<?= base_url('auth') ?>" method="POST" class="pb-3">
                                <div class="form-group position-relative has-icon-left">
                                    <label style="color: black;" for="username">Email</label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control" id="email" value="<?= set_value('email') ?>" name="email">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label style="color: black;" for="password">Password</label>
                                        <a href="<?= base_url('auth/forgotpassword'); ?>" class='float-end'>
                                            <small>Lupa Password?</small>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class='form-check clearfix my-4'>
                                    <div class="float-end">
                                        <a href="<?= base_url('auth/registration'); ?>">Tidak punya akun?</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary float-center">Submit</button> <br>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="<?= base_url() ?>"><i class="far fa-arrow-alt-circle-left"></i>Kembali ke Home</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>