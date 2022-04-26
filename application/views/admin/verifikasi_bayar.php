<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <?= $this->session->flashdata('message');  ?>

            <div class="card">
                <div class="card-body">
                    <table class='table table-striped' id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($tahun_ajaran as $ta) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $ta['tahun_ajaran']; ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/detail_verifikasi/') . $ta['id']; ?>" class="btn bg-success text-white">Lihat</a>
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