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
                                    <td><?= $dv['nama_lengkap']; ?></td>
                                    <td><?= $dv['no_slip']; ?></td>
                                    <td><?= $dv['bukti_bayar']; ?></td>
                                    <td>
                                        <a href="" class="btn bg-success text-white">Lihat</a>
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