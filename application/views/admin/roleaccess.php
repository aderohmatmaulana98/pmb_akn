<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Role Access</h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <?= $this->session->flashdata('message');  ?>
            <div class="col-lg">
                <!-- Hoverable rows start -->
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Tabel Role Access</h4>
                                        <h4>Role : <?= $role['role']; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <!-- table hover -->
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Menu</th>
                                                <th>Access</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($menu as $m) : ?>
                                                <tr>
                                                    <td class="text-bold-500"><?= $i ?></td>
                                                    <td><?= $m['menu'] ?></td>
                                                    <td class="text-bold-500">
                                                        <input type="checkbox" class="form-check-input" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id'] ?>" data-menu="<?= $m['id'] ?>">
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <a href="<?= base_url('admin/role') ?>" class="btn btn-primary my-3"><i data-feather="arrow-left" width="20" class="mb-1"></i>Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hoverable rows end -->
            </div>
        </div>
    </section>
</div>
</div>