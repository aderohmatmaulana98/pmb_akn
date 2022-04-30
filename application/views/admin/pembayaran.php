<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title; ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <?= $this->session->flashdata('message');  ?>

            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="modal-warning me-1 mb-3 d-inline-block ">
                            <!-- Button trigger for warning theme modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#warning">
                                Tambah Data
                            </button>

                            <!--warning theme Modal -->
                            <div class="modal fade text-left" id="warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h5 class="modal-title white" id="myModalLabel140">
                                                Tambah Pembayaran</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('admin/aksi_pembayaran') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="nik" class="form-label">NIK</label> <br>
                                                    <select name="nik" class="form-select" id="nik" required>
                                                        <option value="" selected disabled>Pilih</option>
                                                        <?php foreach ($calon_mhs as $cm) : ?>
                                                            <option value="<?= $cm['nik'] ?>"><?= $cm['nik'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label> <br>
                                                    <select name="nama_lengkap" class="js-example-basic-single" id="nama_lengkap" required>
                                                        <option value="" selected disabled>Pilih</option>
                                                        <?php foreach ($calon_mhs as $cm) : ?>
                                                            <option value="<?= $cm['nama_lengkap'] ?>"><?= $cm['nama_lengkap'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="angkatan" class="form-label">Angkatan</label>
                                                    <select name="angkatan" id="angkatan" class="form-select">
                                                        <?php
                                                        $tg_awal = date('Y') - 10;
                                                        $tgl_akhir = date('Y') + 3;
                                                        for ($i = $tgl_akhir; $i >= $tg_awal; $i--) {
                                                            echo "<option value='$i'";
                                                            if (date('Y') == $i) {
                                                                echo "selected";
                                                            }
                                                            echo ">$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                                                    <input type="number" class="form-control" id="total_pembayaran" value="200000" name="total_pembayaran" readonly>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-warning">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class='table table-striped' id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Kode Transaksi</th>
                                <th>Angkatan</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($pembayaran as $p) :
                            ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $p['nik'] ?></td>
                                    <td><?= $p['nama_lengkap'] ?></td>
                                    <td><?= $p['kode_transaksi'] ?></td>
                                    <td><?= $p['angkatan'] ?></td>
                                    <td><?= $p['total_pembayaran'] ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/cetak_pembayaran') ?>" class="btn btn-success">Cetak</a>
                                    </td>
                                </tr>
                            <?php $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#nik').select2({
        placeholder: "-------Pilih NIK-------"
    });
    $('#nama_lengkap').select2({
        placeholder: "-------Pilih nama lengkap-------"
    });
</script>