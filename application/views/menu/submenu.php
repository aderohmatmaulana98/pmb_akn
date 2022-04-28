<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-lg">
                <?= $this->session->flashdata('message');  ?>
                <div class="mt-3">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Submenu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('menu/submenu') ?>" method="POST">
                                        <div class="form-group">
                                            <label for="menu">Menu</label>
                                            <select class="form-select required" id="basicSelect" name="menu" required>
                                                <option value="">Pilih Menu</option>
                                                <?php foreach ($menu as $m) : ?>
                                                    <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control required" id="title" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="url">Url</label>
                                            <input type="text" class="form-control required" id="url" name="url" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="icon">Icon</label>
                                            <input type="text" class="form-control required" id="icon" name="icon" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="active">Active</label>
                                            <select class="form-select required" id="basicSelect" name="active" required>
                                                <option value="1">Aktif</option>
                                                <option value="0">Tidak Aktif</option>
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

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>MENU</th>
                                    <th>TITLE</th>
                                    <th>URL</th>
                                    <th>ICON</th>
                                    <th>ACTIVE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <td class="text-bold-500"><?= $i ?></td>
                                        <td><?= $sm['menu'] ?></td>
                                        <td><?= $sm['title'] ?></td>
                                        <td><?= $sm['url'] ?></td>
                                        <td><?= $sm['icon'] ?></td>
                                        <td><?= $sm['is_active'] ?></td>
                                        <td class="text-bold-500">
                                            <!-- Edit -->
                                            <a class="btn badge bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal1<?= $sm['id']; ?>"><i data-feather="edit" width="20" class="mb-1"></i>Edit</a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal1<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit submenu</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url('menu/edit_submenu') ?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="form-group" hidden>
                                                                    <label for="id">id</label>
                                                                    <input type="text" class="form-control required" id="id" value="<?= $sm['id'] ?>" name="id">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="menu">Menu</label>
                                                                    <select class="form-select required" id="basicSelect" name="menu" value="<?= set_value('menu') ?>" required>
                                                                        <option value="<?= $sm['menu_id'] ?>" selected><?= $sm['menu']; ?></option>
                                                                        <?php foreach ($menu as $m) : ?>
                                                                            <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="title">Title</label>
                                                                    <input type="text" class="form-control required" id="title" value="<?= $sm['title'] ?>" name="title" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="url">Url</label>
                                                                    <input type="text" class="form-control required" id="url" value="<?= $sm['url'] ?>" name="url" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="icon">Icon</label>
                                                                    <input type="text" class="form-control required" id="icon" value="<?= $sm['icon'] ?>" name="icon" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="active">Active</label>
                                                                    <select class="form-select required" id="basicSelect" name="active" required>
                                                                        <option value="1">Aktif</option>
                                                                        <option value="0">Tidak Aktif</option>
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

                                            <a class="btn badge bg-danger" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" href="<?= base_url('menu/delete_submenu/' . $sm['id']) ?>"><i data-feather="trash-2" width="20" class="mb-1"></i>Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
</div>
</div>