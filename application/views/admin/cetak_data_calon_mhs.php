<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head><body>
    <table style="border: 2px ;">
        <tr>
            <td style="padding: 0px; border: 2px ;" align="center">
                <img src="<?= base_url('assets/landing/assets/img/akn/logo_akn.png'); ?>" height="120px" width="120px" alt="Gambar">
            </td>
            <td width="0%" style="border: 2px ;">
                <h4 class="text-center">AKADEMI KOMUNITAS NEGERI SENI DAN BUDAYA YOGYAKARTA</h4>
                <p class="text-center">Jl. Parangtritis No.364, Pandes, Panggungharjo, Kec. Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55188</p>
            </td>
        </tr>
    </table>

    <hr style=" border: 0; border-style: inset; border-top: 1px solid #000;">
    <h4 class="text-center mt-3">DATA NILAI TEST CALON MAHASISWA</h4>
    <table class="mt-3" style="width: 100%;">
        <tr class="text-center" style="font-size: small;">
            <th style="border: 1px solid black;" scope="col">
                No
            </th>
            <th style="border: 1px solid black;" scope="col">NIK</th>
            <th style="border: 1px solid black;" scope="col">Nama</th>
            <th style="border: 1px solid black;" scope="col">Prodi</th>
            <th style="border: 1px solid black;" scope="col">Gelombang</th>
            <th style="border: 1px solid black;" scope="col">Praktek</th>
            <th style="border: 1px solid black;" scope="col">Wawancara</th>
            <th style="border: 1px solid black;" scope="col">Skor</th>
            <th style="border: 1px solid black;" scope="col">Hasil</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($data_calon_mahasiswa as $dcm) : ?>
            <tr style="font-size: small;">
                <th scope="row" class="text-center" style="border: 1px solid black;"><?= $i; ?></th>
                <td style="border: 1px solid black;"><?= $dcm['nik'] ?></td>
                <td style="border: 1px solid black;"><?= $dcm['nama_lengkap'] ?></td>
                <td style="border: 1px solid black;"><?= $dcm['nama_prodi'] ?></td>
                <td style="border: 1px solid black;"><?= $dcm['gelombang'] ?></td>
                <td style="border: 1px solid black;"><?= $dcm['praktek'] ?></td>
                <td style="border: 1px solid black;"><?= $dcm['wawancara'] ?></td>
                <td style="border: 1px solid black;"><?= $dcm['skor'] ?></td>
                <?php if($dcm['id_pengumuman'] == 1 ): ?>
                <td style="border: 1px solid black;">Lulus</td>
                <?php elseif($dcm['id_pengumuman'] == 2 ) :?>
                <td style="border: 1px solid black;">Tidak Lulus</td>
                <?php else:?>
                    <td style="border: 1px solid black;"></td>
                    <?php endif;?>
            </tr>
        <?php $i++; endforeach; ?>
    </table>

</body></html>