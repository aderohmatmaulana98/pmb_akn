<div class="container">
    <div class="row">
        <div class="text-left mt-3">
            <h2 class="mb-3"><?= $title; ?></h2>
        </div>
        <div class="container">
            <?= $this->session->flashdata('message');  ?>
        </div>
        <div class="col-md-12 col-sm-12 mx-auto mt-3">

            <div class="card pt-4">
                <div class="mx-4 row align-center mx-auto">

                    <form action="<?= base_url('penyeleksi/cetak_data_mhs/') ?>" method="POST">
                        <div class="input-group mb-3">
                            <select name="th_ajaran" id="th_ajaran" class="form-control" required>
                                <option value="" selected disabled>Pilih Tahun Ajaran</option>
                                <?php foreach ($tahun_ajaran as $th) : ?>
                                    <option value="<?= $th['id']; ?>"><?= $th['tahun_ajaran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select name="prodi" id="prodi" class="form-control" required>
                                <option value="" selected disabled>Pilih Prodi</option>
                                <?php foreach ($prodi as $p) : ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['nama_prodi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary"><i data-feather="printer" width="20"></i> Cetak</button>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="example" class="display">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        #
                                    </th>
                                    <th scope="col">No Pendaftaran</th>
                                    <th scope="col">No Induk Kependudukan</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Prodi yang dipilih</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Nilai Praktek</th>
                                    <th scope="col">Nilai Wawancara</th>
                                    <th scope="col">Skor Nilai</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_calon_mahasiswa as $dcm) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $dcm['no_pendaftaran'] ?></td>
                                        <td><?= $dcm['nik'] ?></td>
                                        <td><?= $dcm['nama_lengkap'] ?></td>
                                        <td><?= $dcm['nama_prodi'] ?></td>
                                        <td><?= $dcm['tahun_ajaran'] ?></td>
                                        <td>
                                            <?php if ($dcm['praktek'] == null) : ?>
                                                Belum dinilai
                                            <?php else : ?>
                                                <?= $dcm['praktek'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($dcm['wawancara'] == null) : ?>
                                                Belum dinilai
                                            <?php else : ?>
                                                <?= $dcm['wawancara'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($dcm['skor'] == null) : ?>
                                                Belum dinilai
                                            <?php else : ?>
                                                <?= $dcm['skor'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <?php if ($dcm['skor'] == NULL) : ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $dcm['id']; ?>">
                                                    Input
                                                </button>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $dcm['id']; ?>">
                                                    Update
                                                </button>
                                            <?php endif; ?>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?= $dcm['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?php if ($dcm['skor'] == NULL) : ?>
                                                                <h5 class="modal-title" id="exampleModalLabel">Input Nilai</h5>
                                                            <?php else : ?>
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Nilai</h5>
                                                            <?php endif; ?>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?= base_url('penyeleksi/input_nilai/'.$dcm['id_prodi']) ?>" method="POST">
                                                                <div class="mb-3">
                                                                    <label for="praktek" class="form-label">Nilai Praktek</label>
                                                                    <input type="number" class="form-control" id="praktek" name="praktek" step='0.01' value="<?= $dcm['praktek'] ?>" required>
                                                                    <input type="text" class="form-control" id="id" name="id" value="<?= $dcm['id'] ?>" hidden>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="wawancara" class="form-label">Nilai Wawancara</label>
                                                                    <input type="number" class="form-control" id="wawancara" name="wawancara" step='0.01' value="<?= $dcm['wawancara']; ?>" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
            <div class="text-center mb-5">
                    <a href="<?= base_url('penyeleksi') ?>" class="btn btn-success"><i data-feather="arrow-left" width="20" class="mb-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
</div>