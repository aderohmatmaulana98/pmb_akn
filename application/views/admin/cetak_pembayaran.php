<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cetak bukti pembayaran</title>
</head>

<body>
    <div class="container-sm">
        <h5 class="text-center mt-3 mb-4">BUKTI PEMBAYARAN <br> BIAYA SELEKSI PMB</h5>
        <table class="table table-bordered mt-3" style="width: 100%;">
            <tr class="text-left">
                <th scope="col" style="width: 20%;">Kode Transaksi</th>
                <td scope="col" width="1%">:</td>
                <td scope="col" style="width: 20%;"><?= $pembayaran['kode_transaksi']; ?></td>
            </tr>
            <tr class="text-left">
                <th scope="col" style="width: 20%;">Nama Institusi</th>
                <td scope="col" width="1%">:</td>
                <td scope="col" style="width: 20%;">Akademi Komunitas Negeri Seni dan Budaya Yogyakarta</td>
            </tr>
            <tr class="text-left">
                <th scope="col" style="width: 20%;">Nomor Induk Kependudukan</th>
                <td scope="col" width="1%">:</td>
                <td scope="col" style="width: 20%;"><?= $pembayaran['nik']; ?></td>
            </tr>
            <tr class="text-left">
                <th scope="col" style="width: 20%;">Nama Lengkap</th>
                <td scope="col" width="1%">:</td>
                <td scope="col" style="width: 20%;"><?= $pembayaran['nama_lengkap']; ?></td>
            </tr>
            <tr class="text-left">
                <th scope="col" style="width: 20%;">Angkatan</th>
                <td scope="col" width="1%">:</td>
                <td scope="col" style="width: 20%;"><?= $pembayaran['angkatan']; ?></td>
            </tr>
            <tr class="text-left">
                <th scope="col" style="width: 20%;">Total Bayar</th>
                <td scope="col" width="1%">:</td>
                <td scope="col" style="width: 20%;"><?= $pembayaran['total_pembayaran']; ?></td>
            </tr>
        </table>
    </div>
    <br>
    <div class="text-end container">
        <p>Pengesahan petugas administrasi</p>
        <br><br><br>
        <p><b><u>_________________________________</u></b></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
</body>

</html>