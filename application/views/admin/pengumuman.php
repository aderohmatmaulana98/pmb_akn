<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section mt-4">
        <div class="row mb-2 container-fluid">
        <div class="alert alert-warning alert-dismissible fade show text-dark" role="alert">
        <strong>Perhatian!</strong> Cek penilaian terlebih dahulu sebelum menerbitkan pengumuman.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
            <?= $this->session->flashdata('message');  ?>
            <div class="row">
            <div class="card shadow col-lg-9 mt-2">
                <div class="col-lg-4 mt-3">
                    <form action="<?= base_url('admin/pengumuman') ?> " method="POST">
                    <div class="input-group mb-3">
                            <select name="th_ajaran" id="th_ajaran" class="form-control" required>
                                <option value="" selected disabled>Pilih Tahun Ajaran</option>
                                <?php foreach ($th_ajaran as $ta) : ?>
                                    <option value="<?= $ta['id']; ?>"><?= $ta['tahun_ajaran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('th_ajaran', '<small class="text-danger pl-3">', '</small>'); ?>
                            <button type="submit" class="btn btn-primary"><i data-feather="printer" width="20"></i>Cek Penilaian</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Pendaftaran</th>
                            <th scope="col">No Induk Kependudukan</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $i = 1;
                            foreach ($pengumuman as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $p['no_pendaftaran']; ?></td>
                                    <td><?= $p['nik']; ?></td>
                                    <td><?= $p['nama_lengkap']; ?></td>
                                    <td><?= $p['nama_prodi']; ?></td>
                                    <?php if ($p['skor'] != NULL) :  ?>
                                        <td>Sudah dinilai</td>
                                    <?php else :  ?>
                                        <td>Belum dinilai</td>
                                    <?php endif;  ?>                                
                                </tr>
                            <?php $i++;
                            endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card shadow col-lg-3 mt-2 p-3">
                <div>
                    <h4>Atur form dibawah ini untuk terbitkan pengumuman :</h4>
                    <form class="mt-3">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tahun Ajawan</label>
                            <select class="form-select" name="tahun_ajaran">
                                <option selected disabled>Pilih tahun Ajaran</option>
                                <?php foreach ($th_ajaran as $ta) : ?>
                                    <option value="<?= $ta['id']; ?>"><?= $ta['tahun_ajaran']; ?></option>
                                <?php endforeach; ?>
                            </select>
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