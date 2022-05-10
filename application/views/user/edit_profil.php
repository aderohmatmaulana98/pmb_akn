<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-lg-8">
                <?= $this->session->flashdata('message');  ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('user/edit_profil') ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik" value="<?= $profil['nik']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $profil['nama_lengkap']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $profil['email']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No Whatsapp</label>
                                <input type="text" class="form-control" id="no_wa" name="no_wa" value="<?= $profil['telepon']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $profil['tempat_lahir'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $profil['tanggal_lahir'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10"><?= $profil['alamat'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto profile</label>
                                <input type="file" class="form-control" id="foto" name="foto" value="<?= $profil['image']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <img src="<?= base_url('assets/admin_panel/assets/images/avatar/') . $profil['image'] ?>" width="150" alt="foto_profil">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>