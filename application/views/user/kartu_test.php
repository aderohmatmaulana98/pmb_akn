<!DOCTYPE html>
<html lang="en"><head>
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
    <title>Kartu_ujian</title>
</head><body class="col-lg-7">
    <div class="mt-4 ">
        <table class="tepi" width="600px" >
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
                                    <td width="160px" style="width: 200; border: 0px;"></td>
                                    <td rowspan="4" style="padding-right: 7px; border: 0px; ">
                                        <div class="ml-5" width="500px" style="margin-left: 100px; ">
                                            <span class="border-4">
                                                <img src="<?= base_url('assets/img/pas_foto/') . $kartu_test['pas_foto']; ?>" class="border border-dark" align="right" height="90px" width="70px">
                                            </span>
                                        </div>
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
                                            <td style="font-size: 9pt; border: 0px;"><?= nama_hari(date('l', strtotime($kartu_test["tgl_test"])));   ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Tanggal</b></td>
                                            <td style="font-size: 9pt; border: 0px;">:</td>
                                            <td style="font-size: 9pt; border: 0px;"><?= date('d-m-Y', strtotime($kartu_test["tgl_test"]));   ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Jam</b></td>
                                            <td style="font-size: 9pt; border: 0px;">: </td>
                                            <td style="font-size: 9pt; border: 0px;"><?= date('H:i', strtotime($kartu_test["tgl_test"])) . ' ' . "WIB";   ?></td>
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
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Ruangan Praktek</b></td>
                                            <td style="font-size: 9pt; border: 0px;">:</td>
                                            <td style="font-size: 9pt; border: 0px;"><?= $kartu_test['ruangan_praktek']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 9pt; border: 0px;"><b>Ruangan Wawancara</b></td>
                                            <td style="font-size: 9pt; border: 0px;">:</td>
                                            <td style="font-size: 9pt; border: 0px;"><?= $kartu_test['ruangan_wawancara']; ?></td>
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
</body></html>