<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2 container">
            <?= $this->session->flashdata('message');  ?>

            <div class="card shadow">
                <div class="py-3">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tambah Tahun Ajaran</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('admin/tahun_ajaran') ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                            <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="2021/2022" required>
                                            <?= form_error('tahun_ajaran', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Non Aktif</option>
                                            </select>
                                            <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tahun_ajaran as $ta) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $ta['tahun_ajaran']; ?></td>
                                    <td>
                                        <?php if ($ta['is_active'] == 1) : ?>
                                            Aktif
                                        <?php else : ?>
                                            Non AKtif
                                        <?php endif; ?>
                                    </td>
                                    <td>



                                        <a type="button" class="btn badge bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $ta['id']; ?>">
                                            Edit
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $ta['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Tahun Ajaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="<?= base_url('admin/tahun_ajaran') ?>" method="POST">
                                                            <div class="mb-3">
                                                                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                                                <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" value="<?= $ta['tahun_ajaran']; ?>" required>
                                                                <?= form_error('tahun_ajaran', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="" selected disabled>Pilih Status</option>
                                                                    <option value="1">Aktif</option>
                                                                    <option value="0">Non AKtif</option>

                                                                </select>
                                                                <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                                            </div>
                                                    </div>
                                                    <div class=" modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                </div>

                <a class="btn badge bg-danger" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" href="<?= base_url('admin/delete_tahun_ajaran/' . $ta['id']) ?>">Hapus</a>
                </td>
                </tr>
            <?php $i++;
                            endforeach; ?>
            </tbody>
            </table>
            </div>
        </div>
</div>
</section>
</div>
</div>