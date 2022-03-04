<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12 mx-auto mt-3">

            <div class="card pt-4">
                <h2 class="text-center mb-3">Data Formulir Pendaftaran</h2>
                <div class="text-center">
                    <a href="<?= base_url('user/cetak_kartu_test') ?>" class="btn btn-primary"> <i data-feather="printer" width="20"></i> Cetak Kartu Test</a>
                    <a href="<?= base_url('user/biodata') ?>" class="btn btn-primary"><i data-feather="printer" width="20"></i> Data Cetak Formulir</a>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message');  ?>
                    <table class="table table-bordered">
                        <?php foreach ($formulir as $f) ?>
                        <tr>
                            <th style="width: 50%;">Nomor Induk Kependudukan</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['nik'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Nama Lengkap</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['nama_lengkap'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Tempat Lahir</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['tempat_lahir'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Tanggal Lahir</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= date('d-F-Y', strtotime($f['tanggal_lahir'])); ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Nomor HP</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['telepon'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Jenis Kelamin</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;">
                                <?php if ($f['jenis_kelamin'] == 1) : ?>
                                    Laki - laki
                                <?php else : ?>
                                    Perempuan
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Provinsi</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['nama_provinsi'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Kabupaten</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['kabupaten'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Kecamatan</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['nama_kecamatan'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Alamat</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['alamat'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Agama</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['agama']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Nama Orang Tua</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['nama_ortu']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Pekerjaan Orang Tua</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['pekerjaan_ortu']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Nomor HP Orang Tua</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['telepon_ortu']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Asal Sekolah</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['asal_sekolah']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Tahun Lulus</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><?= $f['tahun_lulus'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Scan KTP</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><a href="<?= base_url('assets/img/ktp/') . $f['ktp'] ?>"><?= $f['ktp'] ?></a></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Scan KK</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><a href="<?= base_url('assets/img/kk/') . $f['kk'] ?>"><?= $f['kk'] ?></a></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Scan Ijazah</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><a href="<?= base_url('assets/img/ijazah/') . $f['ijazah'] ?>"><?= $f['ijazah'] ?></a></td>
                        </tr>
                        <tr>
                            <th style="width: 50%;">Pas Foto</th>
                            <td style="width: 0%;">:</td>
                            <td style="width: 50%;"><img src="<?= base_url('assets/img/pas_foto/') . $f['pas_foto'] ?>" height="150" width="100" alt="Pas Foto"></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>