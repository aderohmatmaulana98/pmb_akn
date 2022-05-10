<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?= $title ?></h3>
    </div>
    <section class="section mt-4">
        <div class="row mb-2">
            <div class="my-4" align="center">
                <?php if($pengumuman['id_pengumuman']==1) : ?>
                <div class="col-lg-7">
                    <div class="col-lg-2 mb-3">
                        <img src="<?= base_url('assets/admin_panel/assets/images/icon/lulus.png'); ?>" width="200" height="200" alt="Lulus">
                    </div>
                    <div>
                        <h2>SELAMAT, ATAS NAMA <b><?= strtoupper($pengumuman['nama_lengkap']) ?></b> DENGAN NIK <b><?= strtoupper($pengumuman['nik']) ?></b> , DITERIMA DI PRODI <b><?= strtoupper($pengumuman['nama_prodi']) ?></b> AKADEMI KOMUNITAS NEGERI SENI DAN BUDAYA YOGYAKARTA</h2>
                    </div>
                </div>
                <?php elseif($pengumuman['id_pengumuman']==2) : ?>
                <div class="col-lg-7">
                    <div class="mb-3">
                        <img src="<?= base_url('assets/admin_panel/assets/images/icon/gagal.png'); ?>" width="200" height="200" alt="Lulus">
                    </div>
                    <div>
                        <h2>MOHON MAAF, PESERTA ATAS NAMA <b><?= strtoupper($pengumuman['nama_lengkap']) ?></b> DENGAN NIK <b><?= strtoupper($pengumuman['nik']) ?></b> DINYATAKAN TIDAK DITERIMA.<br> <br> JANGAN PUTUS ASA DAN TETAP SEMANGAT</h2>
                    </div>
                    
                </div>
                
                <!-- <div class="card shadow mt-5 col-lg-7">
                    <table class="table table-hover">
                        <tr>
                            <th>Nilai Praktek</th>
                            <th>Nilai Wawancara</th>
                            <th>Skor</th>
                        </tr>
                        <tr>
                            <td><?= $pengumuman['praktek'] ?></td>
                            <td><?= $pengumuman['wawancara'] ?></td>
                            <td><?= $pengumuman['skor'] ?></td>
                        </tr>
                    </table>
                </div> -->
            </div>
            <?php else : ?>
            <div class="col-lg-7">
                    <div>
                        <div class="img-responsive">
                            <img src="<?= base_url('assets/admin_panel/assets/images/icon/waiting.png'); ?>" width="500" height="500" alt="Lulus">
                        </div>
                        <h2>BELUM ADA PENGUMUMAN</h2>
                    </div>
                    
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
</div>