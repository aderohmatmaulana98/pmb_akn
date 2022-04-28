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
                                            <form>
                                                <div class="mb-3">
                                                    <label for="nik" class="form-label">NIK</label>
                                                    <input type="text" class="form-control" id="nik" name="nik">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                                                    <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                                    <input type="text" class="form-control" id="tahun_ajaran" value="<?= $pembayaran['tahun_ajaran']; ?>" name="tahun_ajaran">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                                                    <input type="number" class="form-control" id="total_pembayaran" value="200000" name="total_pembayaran" readonly>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>

                                            <button type="submit" class="btn btn-warning ml-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Submit</span>
                                            </button>
                                        </div>
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
                                <th>Tahun Ajaran</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            // foreach ($detail_verifikasi as $dv) : 
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <?php $i++;
                            // endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
</div>