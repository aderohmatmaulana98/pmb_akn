<div class="main-content container-fluid">
    <div class="page-title">
        <h3><?php echo($judul); $title;?></h3>
    </div>
    <section class="section mt-5">
        <div class="row mb-2">
            <?= $this->session->flashdata('message');  ?>
            <div class="card shadow">                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NAMA JURUSAN </th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($prodi as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $p['nama_prodi']; ?></td>
                                    <td>
                                        <a class="btn badge bg-primary" href="<?= base_url('admin/detail/'.$p['id'])?>"><i data-feather="eye" width="20" class="mb-1"></i> Lihat</a>
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