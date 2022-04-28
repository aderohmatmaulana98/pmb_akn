<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
</head><body>
                <h2 align = "center">DATA FORMULIR PENDAFTARAN</h2>
                <br><br>
                <div>
                    <table style="border: 2px solid;">
                        <?php foreach ($biodata as $f) ?>
                        <tr style="border: 2px solid;">
                            <th style="width: 50%; text-align: left; border: 2px solid;">Nomor Induk Kependudukan</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['nik'] ?></td>
                        </tr>
                        <tr style="border: 2px solid;">
                            <th style="width: 50%; text-align: left; border: 2px solid;">Nama Lengkap</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['nama_lengkap'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Tempat Lahir</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['tempat_lahir'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Tanggal Lahir</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= date('d-F-Y', strtotime($f['tanggal_lahir'])); ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Nomor HP</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['telepon'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Jenis Kelamin</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;">
                                <?php if ($f['jenis_kelamin'] == 1) : ?>
                                    Laki - laki
                                <?php else : ?>
                                    Perempuan
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Provinsi</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['nama_provinsi'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Kabupaten</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['kabupaten'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Kecamatan</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['nama_kecamatan'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Alamat</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['alamat'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Agama</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['agama']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left;border: 2px solid;">Nama Orang Tua</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['nama_ortu']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Pekerjaan Orang Tua</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['pekerjaan_ortu']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Nomor HP Orang Tua</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['telepon_ortu']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Asal Sekolah</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['asal_sekolah']; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Tahun Lulus</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><?= $f['tahun_lulus'] ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%; text-align: left; border: 2px solid;">Pas Foto</th>
                            <td style="width: 0%; border: 2px solid;">:</td>
                            <td style="width: 50%; border: 2px solid;"><img src="<?= base_url('assets/img/pas_foto/') . $f['pas_foto'] ?>" height="150" width="100" alt="Pas Foto"></td>
                        </tr>

                    </table>
            </div>
</body></html>