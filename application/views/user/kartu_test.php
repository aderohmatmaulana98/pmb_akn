<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .tepi {
            border-style: solid;
        }

        .label {
            float: left;
            width: 200px;
            padding-right: 20px;
        }

        .input {
            float: left;
            padding-left: 0px;
            padding-right: 20px;
            width: calc(100% - 200px);
        }
    </style>
    <title>Cetak</title>
</head>

<body class="col-lg-7">
    <div class="mt-4 ">
        <table class="tepi" width="600px">
            <tr>
                <td width="1">
                    <div class="mx-3">
                        <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" height="75px" width="80px" alt="">
                    </div>
                </td>
                <td>
                    <div style="text-align: center;" class="">
                        <h7 class=""><b>Akademi Komunitas Negeri Seni dan Budaya Yogyakarta<b></h7>
                        <p align="center" style="font-size: 9pt;">
                            Jl. Parangtritis No.364, Pandes, Panggungharjo, Kec. Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55188 <br>
                            Website: aknyogya.ac.id | PMB AKNSBY 2020
                        </p>
                    </div>
                </td>
            </tr>


        </table>
        <table border="2" class="tepi" width="600px">
            <tr>
                <td>
                    <div style="text-align: left;" class="ml-3">
                        <div class="ml-2">
                            <h7><strong>DATA DIRI</strong> </h7>
                        </div>
                        <div style="line-height: 25px;">
                            <table style="margin-left: 25px;">
                                <tr border="0">

                                    <td style="font-size: 9pt; border: 0px;"><b>No pendaftaran</b></td>
                                    <td style="font-size: 9pt; border: 0px;">:</td>
                                    <td style="font-size: 9pt; border: 0px;"><?= $kartu_test['no_pendaftaran']; ?></td>
                                    <td rowspan="4" width="110px" align="right">
                                        <img src="<?= base_url('assets/img/pas_foto/') . $kartu_test['pas_foto']; ?>" class="border border-dark" height="90px" width="70px">
                                    </td>
                                    <td rowspan="5" style="padding-left: 10px;">
                                        <img src="<?= base_url('assets/img/qr_code/') . $kartu_test['no_pendaftaran'] . '.png'; ?>" class="border border-dark" align="right" height="170px" width="170px">
                                    </td>
                                </tr>
                                <tr style="border: 0px;">
                                    <td style="font-size: 9pt; border: 0px;"><b>Nama peserta</b></td>
                                    <td style="border: 0px;">:</td>
                                    <td style="font-size: 9pt; border: 0px;"><?= $kartu_test['nama_lengkap']; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 9pt; border: 0px;"><b>Jenis Kelamin</b></td>
                                    <td style="font-size: 9pt; border: 0px;">: </td>
                                    <?php if ($kartu_test['jenis_kelamin'] == 1) : ?>
                                        <td style="font-size: 9pt; border: 0px;">Laki - laki</td>
                                    <?php else : ?>
                                        <td style="font-size: 9pt; border: 0px;">Perempuan</td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td style="font-size: 9pt; border: 0px;"><b>Tempat, Tanggal Lahir</b></td>
                                    <td style="font-size: 9pt; border: 0px;">:</td>
                                    <td style="font-size: 9pt; border: 0px;"><?= $kartu_test['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($kartu_test['tanggal_lahir'])); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 9pt; border: 0px;"><b>Prodi Pilihan</b></td>
                                    <td style="font-size: 9pt; border: 0px;">:</td>
                                    <td style="font-size: 9pt; border: 0px;"><?= $kartu_test['nama_prodi']; ?></td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table border="2" class="tepi" style="border-top: 0px;" width="600px">
            <tr>
                <td>
                    <div style="text-align: left;" class="ml-4">
                        <div class="">
                            <h7><strong>JADWAL TEST </strong> </h7>
                            <div style="line-height: normal;">
                                <div style="line-height: 25px;">
                                    <table style="margin-left: 20px;">
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Hari</b></td>
                                            <td style="font-size: 9pt; border: 0px;">:</td>
                                            <?php if ($kartu_test['gelombang'] == 'Gelombang 1') : ?>
                                                <td style="font-size: 9pt; border: 0px;">Selasa</td>
                                            <?php else : ?>
                                                <td style="font-size: 9pt; border: 0px;">Senin</td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Tanggal</b></td>
                                            <td style="font-size: 9pt; border: 0px;">:</td>
                                            <?php if ($kartu_test['gelombang'] == 'Gelombang 1') : ?>
                                                <td style="font-size: 9pt; border: 0px;">14 Juni 2022</td>
                                            <?php else : ?>
                                                <td style="font-size: 9pt; border: 0px;">18 Juli 2022</td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Jam</b></td>
                                            <td style="font-size: 9pt; border: 0px;">: </td>
                                            <td style="font-size: 9pt; border: 0px;">08:00 s/d selesai</td>
                                        </tr>
                                    </table>
                                </div>
                                <h7><strong>LOKASI TEST</strong> </h7>
                                <div style="line-height: 25px;">
                                    <table style="margin-left: 20px;">
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Lokasi</b></td>
                                            <td style="font-size: 9pt; border: 0px;">:</td>
                                            <td style="font-size: 9pt; border: 0px;">Akademi Komunitas Negeri Seni Dan Budaya Yogyakarta</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table border="2" class="tepi" width="600px" style="border-top: 0px;">
            <tr>
                <td>
                    <div style="text-align: left;" class="col-md-15 ml-3">
                        <div class="ml-2">
                            <h7><strong>PERHATIAN</strong> </h7>
                        </div>
                        <div class="ml-0" style="line-height: normal;">
                            <ul>
                                <li style="font-size: 9pt;">
                                    Membawa Kartu Identitas
                                </li>
                                <li style="font-size: 9pt;">
                                    Tidak boleh terlambat, sudah hadir diruangan 15 menit sebelum test
                                </li>
                                <li style="font-size: 9pt;">
                                    Pakaian bebas sopan
                                </li>
                                <li style="font-size: 9pt;">
                                    Peserta diwajibkan membawa kartu test
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="page-break-after: always;"></div>
    <div class="container-lg mt-4">
        <div class="row">
            <div class="col-md-2">
                <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" align="rigth" height="140px" width="140px" alt="">
            </div>
            <div class="col-md-10">
                <h4 class="text-center">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h4>
                <h4 class="text-center">AKADEMI KOMUNITAS NEGERI SENI DAN BUDAYA YOGYAKARTA</h4>
                <p align="center" style="font-size: 12pt;">
                    Jl. Parangtritis No.364, Pandes, Panggungharjo, Kec. Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55188 <br>
                    Website: aknyogya.ac.id | PMB AKNSBY 2022
                </p>
            </div>
            <hr width="100%">
        </div>
        <div class="container">
            <ul>
                <li>
                    <b>DATA PRIBADI CALON MAHASISWA</b>
                </li>
                <li style="list-style: none;">
                    <table>
                        <tbody>
                            <tr>
                                <td width="1%" valign="top">1.</td>
                                <td width="34%">Pilihan Jalur Seleksi</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"> <?= $data_diri['jalur_seleksi'] ?> </td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">2.</td>
                                <td width="34%">Nama Lengkap Pendaftar</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['nama_lengkap'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">3.</td>
                                <td width="34%">Jenis Kelamin</td>
                                <td width="2%">: </td>
                                <?php if ($data_diri['jenis_kelamin'] == 1) : ?>
                                    <td class="" width="64%">Laki - Laki</td>
                                <?php else :  ?>
                                    <td class="" width="64%">Perempuan</td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">4.</td>
                                <td width="34%">Provinsi Tempat Lahir</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['provinsi_tempat_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">5.</td>
                                <td width="34%">Kota/Kab. Tempat Lahir</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['tempat_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">6.</td>
                                <td width="34%">Tanggal Lahir</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['tanggal_lahir'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">7.</td>
                                <td width="34%">Provinsi Tempat Tinggal</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['nama_provinsi'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">8.</td>
                                <td width="34%">Kota/Kab. Tempat Tinggal</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['kabupaten'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">9.</td>
                                <td width="34%">Alamat Lengkap Tempat Tinggal</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">10.</td>
                                <td width="34%">Kecamatan Tempat Tinggal</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['nama_kecamatan'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">11.</td>
                                <td width="34%">Kodepos Tempat Tinggal</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['kode_pos'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">12.</td>
                                <td width="34%">Negara/Kewarganegaraan</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['kewarganegaraan'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">13.</td>
                                <td width="34%">No Telepon/No. HP</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['telepon'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">14.</td>
                                <td width="34%">Status Pernikahan</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['status_pernikahan'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">15.</td>
                                <td width="34%">Agama</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['agama'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">16.</td>
                                <td width="34%">Email</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $data_diri['email'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">17.</td>
                                <td width="34%" valign="top">Pas Foto</td>
                                <td width="2%" valign="top">: </td>
                                <td class="" width="64%">
                                    <img src="<?= base_url('assets/img/pas_foto/') . $kartu_test['pas_foto']; ?>" height="120px" width="80px" alt="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
            <ul>
                <li>
                    <b>DATA SMTA SEKOLAH ASAL</b>
                </li>
                <li style="list-style: none;">
                    <table>
                        <tbody>
                            <tr>
                                <td width="1%" valign="top">1.</td>
                                <td width="34%">Tahun Lulus SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"> <?= $sekolah['tahun_lulus'] ?> </td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">2.</td>
                                <td width="34%">Jurusan SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['jurusan'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">3.</td>
                                <td width="34%">Jenis SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['jenis_sekolah'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">4.</td>
                                <td width="34%">Nama SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['nama_sekolah'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">5.</td>
                                <td width="34%">Provinsi Asal SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['nama_provinsi'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">6.</td>
                                <td width="34%">Alamat Lengkap SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['alamat_lengkap_sekolah'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">7.</td>
                                <td width="34%" valign="top">Status Kelulusan</td>
                                <td width="2%" valign="top">: </td>
                                <td class="" width="64%">
                                    <?php if ($sekolah['status_kelulusan'] == 1) : ?>
                                        <p>Lulus</p>
                                    <?php else : ?>
                                        <p>Belum Lulus</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">8.</td>
                                <td width="34%">No Ijazah SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['no_ijazah'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">9.</td>
                                <td width="34%">Tanggal Ijazah SMTA</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $sekolah['tgl_ijazah'] ?></td>
                            </tr>
                            <tr class="mb-5">
                                <td width="1%" valign="top">10.</td>
                                <td width="34%" valign="top">Data Nilai Raport SMT III</td>
                                <td width="2%" valign="top">: </td>
                                <td class="" width="64%">
                                    <table border="1">
                                        <tr align="center">
                                            <td valign="center" rowspan="3" align="center">Nilai Raport</td>
                                            <td valign="center" colspan="3" align="center">Mata Pelajaran</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Bhs Indonesia</td>
                                            <td>Bhs Inggris</td>
                                            <td>Matematika</td>
                                        </tr>
                                        <tr align="center">
                                            <td><?= $sekolah['bhs_indo_smt3'] ?></td>
                                            <td><?= $sekolah['bhs_inggris_smt3'] ?></td>
                                            <td><?= $sekolah['matematika_smt3'] ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <br>
                            <tr class="mb-5">
                                <td width="1%" valign="top">11.</td>
                                <td width="34%" valign="top">Data Nilai Raport SMT IV</td>
                                <td width="2%" valign="top">: </td>
                                <td class="" width="64%">
                                    <table border="1">
                                        <tr align="center">
                                            <td valign="center" rowspan="3" align="center">Nilai Raport</td>
                                            <td valign="center" colspan="3" align="center">Mata Pelajaran</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Bhs Indonesia</td>
                                            <td>Bhs Inggris</td>
                                            <td>Matematika</td>
                                        </tr>
                                        <tr align="center">
                                            <td><?= $sekolah['bhs_indo_smt4'] ?></td>
                                            <td><?= $sekolah['bhs_inggris_smt4'] ?></td>
                                            <td><?= $sekolah['matematika_smt4'] ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="mb-5">
                                <td width="1%" valign="top">12.</td>
                                <td width="34%" valign="top">Data Nilai Raport SMT IV</td>
                                <td width="2%" valign="top">: </td>
                                <td class="" width="64%">
                                    <table border="1">
                                        <tr align="center">
                                            <td valign="center" rowspan="3" align="center">Nilai Raport</td>
                                            <td valign="center" colspan="3" align="center">Mata Pelajaran</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Bhs Indonesia</td>
                                            <td>Bhs Inggris</td>
                                            <td>Matematika</td>
                                        </tr>
                                        <tr align="center">
                                            <td><?= $sekolah['bhs_indo_smt5'] ?></td>
                                            <td><?= $sekolah['bhs_inggris_smt5'] ?></td>
                                            <td><?= $sekolah['matematika_smt5'] ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">13.</td>
                                <td width="34%" valign="top">Data Nilai Ujian Akhir Nasional/EBTANAS</td>
                                <td width="2%" valign="top">: </td>
                                <td class="" width="64%">
                                    <table border="1">
                                        <tr align="center">
                                            <td valign="center" rowspan="3" align="center">Nilai SKHUN</td>
                                            <td valign="center" colspan="3" align="center">Mata Pelajaran</td>
                                        </tr>
                                        <tr align="center">
                                            <td>Bhs Indonesia</td>
                                            <td>Bhs Inggris</td>
                                            <td>Matematika</td>
                                        </tr>
                                        <tr align="center">
                                            <td><?= $sekolah['bhs_indonesia'] ?></td>
                                            <td><?= $sekolah['bhs_inggris'] ?></td>
                                            <td><?= $sekolah['matematika'] ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="pt-3" width="1%" valign="top">14.</td>
                                <td class="pt-3" width="34%" valign="top">Data Prestasi 3 Tahun Terakhir</td>
                                <td class="pt-3" width="2%" valign="top">: </td>
                                <td class="pt-3" width="64%">
                                    <table border="1">
                                        <tr class="text-center">
                                            <td>No</td>
                                            <td>Jenis Lomba Kegiatan</td>
                                            <td>Tingkat Kejuaraan</td>
                                            <td>Prestasi Juara Ke</td>
                                        </tr>
                                        <?php $i = 1;
                                        foreach ($prestasi as $p) : ?>
                                            <tr class="text-center">
                                                <td><?= $i; ?></td>
                                                <td><?= $p['jenis_kegiatan_lomba'] ?></td>
                                                <td><?= $p['tingkat_kejuaraan'] ?></td>
                                                <td><?= $p['prestasi_juara_ke'] ?></td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
            <ul>
                <li>
                    <b>DATA ORANG TUA</b>
                </li>
                <li style="list-style: none;">
                    <table>
                        <tbody>
                            <tr>
                                <td width="1%" valign="top">1.</td>
                                <td width="34%">Nama Ayah</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"> <?= $ortu['nama_ayah'] ?> </td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">2.</td>
                                <td width="34%">Pendidikan Terakhir Ayah</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['pendidikan_terakhir_ayah'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">3.</td>
                                <td width="34%">Pekerjaan Ayah</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['pekerjaan_ayah']; ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">4.</td>
                                <td width="34%">Penghasilan Ayah</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['penghasilan_ayah'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">5.</td>
                                <td width="34%">Nama Ibu</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['nama_ibu'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">6.</td>
                                <td width="34%">Pendidikan Terakhir Ibu</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['pendidikan_terakhir_ibu'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">7.</td>
                                <td width="34%">Pekerjaan Ibu</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['pekerjaan_ibu'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">8.</td>
                                <td width="34%">Penghasilan Ibu</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['penghasilan_ibu'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">9.</td>
                                <td width="34%">Alamat Lengkap Orang Tua</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['alamat_lengkap_ortu'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">10.</td>
                                <td width="34%">Provinsi Asal Orang Tua</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['nama_provinsi'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">11.</td>
                                <td width="34%">Kota / Kabupaten Orang Tua</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['kabupaten'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">12.</td>
                                <td width="34%">Kode Pos Alamat Orang Tua</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['kode_pos_ortu'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">13.</td>
                                <td width="34%">Nama Wali(Jika Ada)</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['nama_wali'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">14.</td>
                                <td width="34%">Pekerjaan Wali</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['pekerjaan_wali'] ?></td>
                            </tr>
                            <tr>
                                <td width="1%" valign="top">15.</td>
                                <td width="34%">Alamat Lengkap Wali</td>
                                <td width="2%">: </td>
                                <td class="" width="64%"><?= $ortu['alamat_lengkap_wali'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
            <br>
            <div class="text-right">
                <p>Yogyakarta,</p>
                <p>Pendaftar/Calon Mahasiswa</p>
                <br><br>
                <p><?= $data_diri['nama_lengkap'] ?></p>
            </div>
        </div>
    </div>
    <div style="page-break-after: always;"></div>
    <br>
    <div class="container-sm mt-5">
        <div>
            <h4 class="text-center">
                SURAT PERNYATAAN <br> MENJADI MAHASISWA AKADEMI KOMUNITAS NEGERI SENI DAN BUDAYA YOGYAKARTA
                <br> TAHUN AKADEMIK <?= $kartu_test['tahun_ajaran'] ?>
            </h4>
        </div>
        <div>
            <p>Saya yang bertanda tangan dibawah ini :</p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $data_diri['nama_lengkap'] ?></td>
                </tr>
                <tr>
                    <td>No Test</td>
                    <td>:</td>
                    <td><?= $data_diri['no_pendaftaran'] ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $data_diri['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($data_diri['tanggal_lahir'])) ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $data_diri['alamat']; ?></td>
                </tr>
            </table>
            <br>
            <?= $surat_pernyataan['surat_pernyataan']; ?>
            <br>
            <br>
            <p class="text-right">Yogyakarta, <?= date('d-m-Y'); ?></p>
            <br>
            <p class="text-right" style="font-size: 9pt; margin-right: 80px;">Materai Rp.10000,-</p>
            <br>
            <p class="text-right">(<?= $data_diri['nama_lengkap'] ?>)</p>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>