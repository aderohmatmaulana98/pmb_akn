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
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Kode Transaksi</th>
                                <th>Bukti Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($detail_verifikasi as $dv) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $dv['nik']; ?></td>
                                    <td><?= $dv['nama_lengkap']; ?></td>
                                    <td><?= $dv['no_slip']; ?></td>
                                    <td><a href="<?= base_url('/assets/img/bukti_bayar/') . $dv['bukti_bayar'] ?>" class="btn bg-success text-white">Lihat</a></td>
                                    <td>
                                        <?php if ($dv['status_bayar'] == NULL || $dv['status_bayar'] == 0) : ?>
                                            <a href="<?= base_url('admin/konfirmasi/') . $dv['id_tahun_ajaran'] . '/' . $dv['id'] ?>" class="btn bg-success text-white"><i data-feather="check" width="40"></i></a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/batal_konfirmasi/') . $dv['id_tahun_ajaran'] . '/' . $dv['id'] ?>" class="btn bg-danger text-white"><i data-feather="x" width="40"></i></a>
                                        <?php endif; ?>

                                        <a href="" class="btn bg-danger text-white"><i data-feather="trash-2" width="40"></i></a>
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