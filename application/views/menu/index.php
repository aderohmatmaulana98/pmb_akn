<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-lg-8">
                <?= $this->session->flashdata('message');  ?>
                <div class="mt-3">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('menu/index'); ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="menu" class="form-label">Menu</label>
                                            <input type="text" class="form-control" id="menu" value="<?= set_value('menu') ?>" name="menu">
                                            <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
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

                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['menu'] ?></td>
                                <td>
                                    <a class="btn badge bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $m['id']; ?>">Edit</a>

                                    <div class="modal fade" id="exampleModal1<?= $m['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('menu/edit_menu') ?>" method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu'] ?>">
                                                                <input type="hidden" id="id" name="id" value="<?= $m['id'] ?>">
                                                            </div>
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

                                    <a class="btn badge bg-danger" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" href="<?= base_url('menu/delete_menu/' . $m['id']) ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>