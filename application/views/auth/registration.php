     <div class="container">
         <div class="row">
             <div class="col-md-7 col-sm-12 mx-auto">
                 <div class="card pt-4 " style="background-color: rgba(231, 224, 255, 0.8);">
                     <div class="card-body">
                         <div class="text-center mb-5 text-dark">
                             <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" height="120" width="120" class='mb-4'>
                             <h3 class="text-dark">Sign Up</h3>
                             <p>Please fill the form to register.</p>
                         </div>
                         <form action="<?= base_url('auth/registration') ?>" method="POST">
                             <div class="row">
                                 <div class="col-md-6 col-12">
                                     <div class="form-group">
                                         <label for="nik">NIK</label>
                                         <input type="number" id="nik" class="form-control" value="<?= set_value('nik') ?>" name="nik">
                                         <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                     <div class="form-group">
                                         <label for="fullname">Nama Lengkap</label>
                                         <input type="text" id="fullname" class="form-control" value="<?= set_value('fullname') ?>" name="fullname">
                                         <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                     <div class="form-group">
                                         <label for="no_wa">No Whatsapp</label>
                                         <input type="text" id="no_wa" class="form-control" name="no_wa" value="<?= set_value('no_wa') ?>">
                                         <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                     <div class="form-group">
                                         <label for="email">Email</label>
                                         <input type="email" id="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                                         <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                     <div class="form-group">
                                         <label for="password1">Password</label>
                                         <input type="password" id="password1" class="form-control" name="password1">
                                         <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                     <div class="form-group">
                                         <label for="password2">Konfirmasi Password</label>
                                         <input type="password" id="password2" class="form-control" name="password2">
                                     </div>
                                 </div>
                             </diV>

                             <a href="<?= base_url('auth') ?>">Sudah punya akun? Login</a>
                             <div class="clearfix text-center mt-4">
                                 <button type="submit" class="btn btn-primary ">Submit</button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>