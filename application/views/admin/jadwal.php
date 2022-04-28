<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section mt-4">
        <div class="row mb-2 container-fluid">
            <?= $this->session->flashdata('message');  ?>
            <div class="card shadow mt-2">
                <div class="my-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('admin/tambah_jadwal') ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="gelombang" class="form-label">Gelombang</label>
                                            <input type="text" class="form-control" id="gelombang" name="gelombang" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_buka" class="form-label">Tanggal Buka</label>
                                            <input type="date" class="form-control" id="tgl_buka" name="tgl_buka" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_tutup" class="form-label">Tanggal Tutup</label>
                                            <input type="date" class="form-control" id="tgl_tutup" name="tgl_tutup" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_test" class="form-label">Tanggal Test</label>
                                            <input type="datetime-local" class="form-control" id="tgl_test" name="tgl_test" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="status" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="1">Buka</option>
                                                <option value="0">Tutup</option>
                                            </select>
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
                <div class="table-responsive-lg">
                    
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gelombang</th>
                            <th scope="col">Tanggal Buka</th>
                            <th scope="col">Tanggal Tutup</th>
                            <th scope="col">Tanggal Test</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($jadwal as $j) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $j['gelombang']; ?></td>
                                <td><?= date('d-F-Y', strtotime($j['tgl_buka'])); ?></td>
                                <td><?= date('d-F-Y', strtotime($j['tgl_berakhir'])); ?></td>
                                <td><?= date('d-F-Y H:i', strtotime($j['tgl_test'])); ?></td>
                                <?php if ($j['is_active'] == 1) :  ?>
                                    <td>Buka</td>
                                <?php else :  ?>
                                    <td>Tutup</td>
                                <?php endif;  ?>
                                <td>
                                    <a href="#" class="btn badge bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $j['id']; ?>">Edit</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal1<?= $j['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('admin/edit_jadwal') ?>" method="POST">
                                                        <div class="mb-3">
                                                            <label for="gelombang" class="form-label">Gelombang</label>
                                                            <input type="text" value="<?= $j['gelombang']; ?>" class="form-control" name="gelombang" id="gelombang" required>
                                                            <input type="text" value="<?= $j['id']; ?>" class="form-control" name="id" id="id" hidden>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tgl_buka" class="form-label">Tanggal Buka</label>
                                                            <input type="date" value="<?= $j['tgl_buka']; ?>" class="form-control" id="tgl_buka" name="tgl_buka" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tgl_berakhir" class="form-label">Tanggal Tutup</label>
                                                            <input type="date" value="<?= $j['tgl_berakhir']; ?>" class="form-control" id="tgl_berakhir" name="tgl_berakhir" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tgl_test" class="form-label">Tanggal Test</label>
                                                            <input type="datetime-local" value="<?= date('Y-m-d\TH:i:s', strtotime($j['tgl_test'])); ?>" class="form-control" id="tgl_test" name="tgl_test" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select name="status" id="status" class="form-control" required>
                                                                <option value="" selected disabled>Pilih Status</option>
                                                                <option value="1">Buka</option>
                                                                <option value="0">Tutup</option>
                                                            </select>
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
                                    <a class="btn badge bg-danger" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" href="<?= base_url('admin/delete_jadwal/' . $j['id']) ?>">Hapus</a>
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