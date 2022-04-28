<div class="main-content container-fluid">
    <div class="page-title mb-3">
        <h3><?php echo ($judul);
            $title; ?></h3>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="row text-center mb-5 border-white border-2" id="judul">
                <?= $this->session->flashdata('message');  ?>
                <div class="col-md-3 bg-info btn" id="judul_biodata">
                    <h6 class="card-subtitle text-white btn btn-lg col-lg">BIODATA </h6>
                </div>
                <div class="col-md-3 bg-primary btn" id="judul_sekolah_asal">
                    <h6 class="card-subtitle text-white btn btn-lg col-lg">SEKOLAH ASAL</h6>
                </div>
                <div class="col-md-3 bg-primary btn" id="judul_prestasi">
                    <h6 class="card-subtitle text-white btn btn-lg col-lg">PRESTASI</h6>
                </div>
                <div class="col-md-3 bg-primary btn" id="judul_data_orang_tua">
                    <h6 class="card-subtitle text-white btn btn-lg col-lg">DATA ORANG TUA</h6>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card p-5" id="biodata">
                <form action="<?= base_url('admin/edit_data_biodata') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3" hidden>
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $detail_form['id']; ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $detail_form['nama_lengkap']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jalur_seleksi" class="form-label">Jalur Seleksi</label>
                        <input type="text" class="form-control" id="jalur_seleksi" name="jalur_seleksi" value="AKNSBY (Kemitraan Pemprov DIY)" required>
                    </div>
                    <div class="mb-3">
                        <label for="jalur_seleksi" class="form-label">Prodi Pilihan</label>
                        <select class="form-select" id="prodi" name="prodi" required>
                            <?php foreach ($prodi as $p) : ?>
                                <option <?= ($p['nama_prodi'] == $detail_form['nama_prodi']) ? 'selected' : '' ?> value="<?= $p['id'] ?>"><?= $p['nama_prodi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ttl" class="form-label">Tempat, Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $detail_form['tempat_lahir']; ?>" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="tgl_lahir" value="<?= $detail_form['tanggal_lahir']; ?>" name="tgl_lahir" required>
                            </div>
                            <small>Sesuaikan dengan ijazah</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi_tempat_lahir" class="form-label">Provinsi Tempat Lahir</label>
                        <select class="form-select" id="provinsi_tempat_lahir" name="provinsi_tempat_lahir" required>
                            <option value="" disabled>Pilih Provinsi</option>
                            <?php foreach ($provinsi as $prov_lahir) : ?>
                                <option <?= ($prov_lahir['nama_provinsi'] == $detail_form['provinsi_tempat_lahir']) ? 'selected' : '' ?> value="<?= $prov_lahir['nama_provinsi'] ?>"><?= $prov_lahir['nama_provinsi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $detail_form['nik']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option <?= ('1' == $detail_form['jenis_kelamin']) ? 'selected' : '' ?> value="1">Laki - Laki</option>
                            <option <?= ('2' == $detail_form['jenis_kelamin']) ? 'selected' : '' ?> value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                        <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                            <option value="" disabled>Pilih Status Pernikahan</option>
                            <option <?= ('Sudah Menikah' == $detail_form['status_pernikahan']) ? 'selected' : '' ?> value="Sudah Menikah">Sudah Menikah</option>
                            <option <?= ('Belum Menikah' == $detail_form['status_pernikahan']) ? 'selected' : '' ?> value="Belum Menikah">Belum Menikah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select name="agama" id="agama" class="form-control" required>
                            <option value="" disabled>Pilih Agama</option>
                            <option <?= ('Islam' == $detail_form['agama']) ? 'selected' : '' ?> value="Islam">Islam</option>
                            <option <?= ('Kristen Protestan' == $detail_form['agama']) ? 'selected' : '' ?> value="Kristen Protestan">Kristen Protestan</option>
                            <option <?= ('Katholik' == $detail_form['agama']) ? 'selected' : '' ?> value="Katholik">Katholik</option>
                            <option <?= ('Hindu' == $detail_form['agama']) ? 'selected' : '' ?> value="Hindu">Hindu</option>
                            <option <?= ('Budha' == $detail_form['agama']) ? 'selected' : '' ?> value="Budha">Budha</option>
                            <option <?= ('Kong Hu Cu' == $detail_form['agama']) ? 'selected' : '' ?> value="Kong Hu Cu">Kong Hu Cu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No Hp / Whatsapp</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $detail_form['telepon'] ?>" required>
                        <small>Masukan dengan awalan kode 62xxxx (format internasional)</small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $detail_form['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" id="alamat_lengkap" cols="30" rows="10" required><?= $detail_form['alamat']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi_tempat_tinggal" class="form-label">Provinsi Tempat Tinggal</label>
                        <select name="provinsi" class="form-control" id="provinsi" required>
                            <option value="" disabled>Pilih Provinsi</option>
                            <?php foreach ($provinsi as $prov) : ?>
                                <option <?= ($prov['nama_provinsi'] == $detail_form['nama_provinsi']) ? 'selected' : '' ?> value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten_tempat_tinggal" class="form-label">Kabupaten Tempat Tinggal</label>
                        <select name="kabupaten" class="form-control" id="kabupaten" required>
                            <?php foreach ($kabupaten as $kab) : ?>
                                <option <?= ($kab['kabupaten'] == $detail_form['kabupaten']) ? 'selected' : '' ?> value="<?= $kab['id'] ?>"><?= $kab['kabupaten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan_tempat_tinggal" class="form-label">Kecamatan Tempat Tinggal</label>
                        <select name="kecamatan" class="form-control" id="kecamatan" required>
                            <?php foreach ($kecamatan as $kec) : ?>
                                <option <?= ($kec['nama_kecamatan'] == $detail_form['nama_kecamatan']) ? 'selected' : '' ?> value="<?= $kec['id'] ?>"><?= $kec['nama_kecamatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_pos" class="form-label">Kode Pos Tempat Tinggal</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= $detail_form['kode_pos'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="kewarganegaraan" value="<?= $detail_form['kewarganegaraan'] ?>" name="kewarganegaraan" required>
                    </div>
                    <div class="mb-3">
                        <label for="pas_foto" class="form-label">Pas foto</label> <br>
                        <img src="<?= base_url('assets/img/pas_foto/') . $detail_form['pas_foto'] ?>" width="150" height="208">
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>

            <div class="card visually-hidden p-5" id="data_sekolah">
                <form action="<?= base_url('admin/edit_data_sekolah'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3" hidden>
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $detail_sekolah['id']; ?>" readonly required>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $detail_form['nik']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label><br>
                        <input type="text" class="form-control" value="<?= $detail_sekolah['nama_sekolah'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_sekolah" class="form-label">Jenis Sekolah</label>
                        <select name="jenis_sekolah" class="form-select" id="jenis_sekolah" required>
                            <option value="" selected disabled>Pilih Jenis Sekolah</option>
                            <?php foreach ($status_sekolah as $ss) : ?>
                                <option <?= ($ss['status'] == $detail_sekolah['jenis_sekolah']) ? 'selected' : '' ?> value="<?= $ss['status'] ?>"><?= $ss['status'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi_asal_sekolah" class="form-label">Provinsi Asal Sekolah</label>
                        <select name="provinsi_asal_sekolah" class="form-select" id="provinsi_asal_sekolah" required>
                            <option value="" disabled>Pilih Asal Sekolah</option>
                            <?php foreach ($provinsi as $pr) : ?>
                                <option <?= ($pr['id'] == $detail_sekolah['id_provinsi']) ? 'selected' : '' ?> value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_lengkap_sekolah" class="form-label">Alamat Lengkap Sekolah</label>
                        <textarea name="alamat_lengkap_sekolah" class="form-control" id="alamat_lengkap_sekolah" cols="30" rows="10" required><?= $detail_sekolah['alamat_lengkap_sekolah']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $detail_sekolah['jurusan']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                        <select class="form-select" name="status_kelulusan" id="status_kelulusan" required>
                            <option disabled>Pilih status kelulusan</option>
                            <option <?= ('0' == $detail_sekolah['status_kelulusan']) ? 'selected' : '' ?> value="0">Belum Lulus</option>
                            <option <?= ('1' == $detail_sekolah['status_kelulusan']) ? 'selected' : '' ?> value="1">Sudah Lulus</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" id="tahun_lulus" value="<?= $detail_sekolah['tahun_lulus']; ?>" name="tahun_lulus" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_ijazah" class="form-label">No Ijazah</label>
                        <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" value="<?= $detail_sekolah['no_ijazah']; ?>" required>
                        <small>Jika belum ada, isi dengan angka 0 atau -</small>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_ijazah" class="form-label">Tanggal Ijazah</label>
                        <input type="date" class="form-control" id="tgl_ijazah" value="<?php echo date("Y-m-d", strtotime($detail_sekolah['tgl_ijazah'])); ?>" name="tgl_ijazah" required>
                    </div>
                    <div class="mb-3">
                        <label for="data_nilai" class="form-label">Data Nilai Ujian Akhir Nasional/EBTANAS</label>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="bhs_indonesia" class="form-label">Bhs Indonesia</label>
                                <input type="text" class="form-control" id="bhs_indonesia" name="bhs_indonesia" value="<?= $detail_sekolah['bhs_indonesia']; ?>" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="bhs_inggris" class="form-label">Bhs Inggris</label>
                                <input type="text" class="form-control" id="bhs_inggris" name="bhs_inggris" value="<?= $detail_sekolah['bhs_inggris']; ?>" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="matematika" class="form-label">Matematika</label>
                                <input type="text" class="form-control" id="matematika" name="matematika" value="<?= $detail_sekolah['matematika']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>

            <div class="card visually-hidden p-5" id="data_prestasi">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis Kegiatan Lomba</th>
                            <th scope="col">Tingkat Kejuaraan</th>
                            <th scope="col">Prestasi Juara Ke</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($data_prestasi as $dp) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $dp['jenis_kegiatan_lomba']; ?></td>
                                <td><?= $dp['tingkat_kejuaraan']; ?></td>
                                <td><?= $dp['prestasi_juara_ke']; ?></td>
                                <td>
                                    <span class="badge bg-success"><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $dp['id'] ?>"><i class="text-white" data-feather="edit"></i></a></span>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $dp['id']  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Prestasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('admin/edit_data_prestasi') ?>" method="POST" enctype="multipart/form-data">
                                                        <div class="mb-3" hidden>
                                                            <label for="id" class="form-label">id</label>
                                                            <input type="text" class="form-control" id="id" name="id" value="<?= $dp['id']; ?>" required>
                                                        </div>
                                                        <div class="mb-3" hidden>
                                                            <label for="id" class="form-label">nik</label>
                                                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $dp['nik']; ?>" required>
                                                        </div>
                                                        <div class="mb-3" hidden>
                                                            <label for="id" class="form-label">ID User</label>
                                                            <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $dp['id_user']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jenis_kegiatan_lomba" class="form-label">Jenis Kegiatan Lomba</label>
                                                            <input type="text" class="form-control" id="jenis_kegiatan_lomba" name="jenis_kegiatan_lomba" value="<?= $dp['jenis_kegiatan_lomba']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tingkat_kejuaraan" class="form-label">Tingkat Kejuaraan</label>
                                                            <select class="form-select" id="tingkat_kejuaraan" name="tingkat_kejuaraan">
                                                                <option disabled selected>Pilih Tingkat Kejuaraan</option>
                                                                <option <?= ('Internasional' == $dp['tingkat_kejuaraan']) ? 'selected' : '' ?> value="Internasional">Internasional</option>
                                                                <option <?= ('Nasional' == $dp['tingkat_kejuaraan']) ? 'selected' : '' ?> value="Nasional">Nasional</option>
                                                                <option <?= ('Provinsi' == $dp['tingkat_kejuaraan']) ? 'selected' : '' ?> value="Provinsi">Provinsi</option>
                                                                <option <?= ('Kabupaten/Kota' == $dp['tingkat_kejuaraan']) ? 'selected' : '' ?> value="Kabupaten/Kota">Kabupaten/Kota</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="prestasi_juara_ke" class="form-label">Prestasi Juara Ke</label>
                                                            <input type="text" class="form-control" id="prestasi_juara_ke" name="prestasi_juara_ke" value="<?= $dp['prestasi_juara_ke']; ?>" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="badge bg-danger"><a onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" href="<?= base_url('admin/hapus_prestasi/') . $dp['nik'] . '/' . $dp['id_user'] . '/' . $dp['id'] ?>"><i class="text-white" data-feather="trash"></i></a></span>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="card p-5 visually-hidden" id="data_ortu">
                <form action="<?= base_url('admin/edit_data_ortu') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3" hidden>
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $data_ortu['id']; ?>" readonly required>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="nik" class="form-label">nik</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $data_ortu['nik']; ?>" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $data_ortu['nama_ayah']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_terakhir_ayah" class="form-label">Pendidikan Terakhir Ayah</label>
                        <select class="form-select" name="pendidikan_terakhir_ayah" id="pendidikan_terakhir_ayah" required>
                            <option disabled>Pilih pendidikan terakhir ayah</option>
                            <option <?= ('SD' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="SD">SD</option>
                            <option <?= ('SMP' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="SMP">SMP</option>
                            <option <?= ('SMA' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="SMA">SMA</option>
                            <option <?= ('S1' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="S1">S1</option>
                            <option <?= ('S2' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="S2">S2</option>
                            <option <?= ('S3' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="S3">S3</option>
                            <option <?= ('Tidak Ada' == $data_ortu['pendidikan_terakhir_ayah']) ? 'selected' : '' ?> value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?= $data_ortu['pekerjaan_ayah']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                        <select class="form-select" id="penghasilan_ayah" name="penghasilan_ayah" required>
                            <option selected disabled>Pilih Penghasilan Ayah</option>
                            <option <?= ('Kurang dari Rp.500.000' == $data_ortu['penghasilan_ayah']) ? 'selected' : '' ?> value="Kurang dari Rp.500.000">Kurang dari Rp.500.000</option>
                            <option <?= ('Rp.1.000.000-Rp.1999.999' == $data_ortu['penghasilan_ayah']) ? 'selected' : '' ?> value="Rp.1.000.000-Rp.1999.999">Rp.1.000.000-Rp.1999.999</option>
                            <option <?= ('Rp.2.000.000-Rp.4999.999' == $data_ortu['penghasilan_ayah']) ? 'selected' : '' ?> value="Rp.2.000.000-Rp.4999.999">Rp.2.000.000-Rp.4999.999</option>
                            <option <?= ('Rp.5.000.000-Rp.20.000.000' == $data_ortu['penghasilan_ayah']) ? 'selected' : '' ?> value="Rp.5.000.000-Rp.20.000.000">Rp.5.000.000-Rp.20.000.000</option>
                            <option <?= ('Lebih dari Rp.20.000.000' == $data_ortu['penghasilan_ayah']) ? 'selected' : '' ?> value="Lebih dari Rp.20.000.000">Lebih dari Rp.20.000.000</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $data_ortu['nama_ibu'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pendidikan_ibu" class="form-label">Pendidikan Terakhir Ibu</label>
                        <select class="form-select" name="pendidikan_ibu" id="pendidikan_ibu">
                            <option disabled>Pilih pendidikan terakhir ibu</option>
                            <option <?= ('SD' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="SD">SD</option>
                            <option <?= ('SMP' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="SMP">SMP</option>
                            <option <?= ('SMA' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="SMA">SMA</option>
                            <option <?= ('S1' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="S1">S1</option>
                            <option <?= ('S2' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="S2">S2</option>
                            <option <?= ('S3' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="S3">S3</option>
                            <option <?= ('Tidak Ada' == $data_ortu['pendidikan_terakhir_ibu']) ? 'selected' : '' ?> value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?= $data_ortu['pekerjaan_ibu']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                        <select class="form-select" id="penghasilan_ibu" name="penghasilan_ibu" required>
                            <option disabled>Pilih Penghasilan Ibu</option>
                            <option <?= ('Kurang dari Rp.500.000' == $data_ortu['penghasilan_ibu']) ? 'selected' : '' ?> value="Kurang dari Rp.500.000">Kurang dari Rp.500.000</option>
                            <option <?= ('Rp.1.000.000-Rp.1999.999' == $data_ortu['penghasilan_ibu']) ? 'selected' : '' ?> value="Rp.1.000.000-Rp.1999.999">Rp.1.000.000-Rp.1999.999</option>
                            <option <?= ('Rp.2.000.000-Rp.4999.999' == $data_ortu['penghasilan_ibu']) ? 'selected' : '' ?> value="Rp.2.000.000-Rp.4999.999">Rp.2.000.000-Rp.4999.999</option>
                            <option <?= ('Rp.5.000.000-Rp.20.000.000' == $data_ortu['penghasilan_ibu']) ? 'selected' : '' ?> value="Rp.5.000.000-Rp.20.000.000">Rp.5.000.000-Rp.20.000.000</option>
                            <option <?= ('Lebih dari Rp.20.000.000' == $data_ortu['penghasilan_ibu']) ? 'selected' : '' ?> value="Lebih dari Rp.20.000.000">Lebih dari Rp.20.000.000</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_lengkap_ortu" class="form-label">Alamat Lengkap Orang Tua</label>
                        <textarea name="alamat_lengkap_ortu" class="form-control" id="alamat_lengkap_ortu" cols="30" rows="10" required><?= $data_ortu['alamat_lengkap_ortu']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi_asal_orang_tua" class="form-label">Provinsi Asal Orang Tua</label>
                        <select name="provinsi_asal_orang_tua" class="form-control" id="provinsi_asal_orang_tua" required>
                            <option value="" selected disabled>Pilih Provinsi Asal Orang Tua</option>
                            <?php foreach ($provinsi as $prov) : ?>
                                <option <?= ($prov['id'] == $data_ortu['id_provinsi_asal_ortu']) ? 'selected' : '' ?> value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten_asal_orang_tua" class="form-label">Kabupaten Asal Orang Tua</label>
                        <select name="kabupaten_asal_orang_tua" class="form-control" id="kabupaten_asal_orang_tua" required>
                            <option value="" selected disabled>Pilih Kabupaten Asal Orang Tua</option>
                            <?php foreach ($kabupaten as $kab) : ?>
                                <option <?= ($kab['id'] == $data_ortu['id_kabupaten_ortu']) ? 'selected' : '' ?> value="<?= $kab['id']; ?>"><?= $kab['kabupaten']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kodepos_alamat_orang_tua" class="form-label">Kodepos Alamat Orang Tua</label>
                        <input type="text" class="form-control" id="kodepos_alamat_orang_tua" name="kodepos_alamat_orang_tua" value="<?= $data_ortu['kode_pos_ortu'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp_orang_tua" class="form-label">No Telp Orang Tua</label>
                        <input type="text" class="form-control" id="no_telp_orang_tua" name="no_telp_orang_tua" value="<?= $data_ortu['telepon_ortu'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_wali" class="form-label">Nama Wali (Jika Ada)</label>
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?= $data_ortu['nama_wali'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                        <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="<?= $data_ortu['pekerjaan_wali'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="alamat_lengkap_wali" class="form-label">Alamat Lengkap Wali</label>
                        <textarea name="alamat_lengkap_wali" class="form-control" id="alamat_lengkap_wali" cols="30" rows="10"><?= $data_ortu['alamat_lengkap_wali'] ?></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>

            </div>
            <div class="card p-3">
                <div class="row text-center">
                    <?php if ($detail_form['status_finalisasi'] == 0) : ?>
                        <span class="col-lg-4">
                            <a href="<?= base_url('admin/finalisasi/') . $detail_form['nik'] . '/' . $detail_form['id_user'] . '/' . $detail_form['id']; ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Finalisasi Sekarang"><i data-feather="check"></i> Finalisasi Data</a>
                        </span>
                    <?php else : ?>
                        <span class="col-lg-4">
                            <a href="<?= base_url('admin/batal_finalisasi/') . $detail_form['nik'] . '/' . $detail_form['id_user'] . '/' . $detail_form['id']; ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Finalisasi"><i data-feather="x-square"></i> Batalkan Finalisasi Data</a>
                        </span>
                    <?php endif; ?>
                    <?php if ($detail_form['status_validasi_berkas'] == 0) : ?>
                        <span class="col-lg-4">
                            <a href="<?= base_url('admin/status_validasi_berkas/') . $detail_form['nik'] . '/' . $detail_form['id_user'] . '/' . $detail_form['id']; ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Validasi Sekarang"><i data-feather="check"></i> Validasi Berkas Data</a>
                        </span>
                    <?php else : ?>
                        <span class="col-lg-4">
                            <a href="<?= base_url('admin/batal_status_validasi_berkas/') . $detail_form['nik'] . '/' . $detail_form['id_user'] . '/' . $detail_form['id']; ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Validasi"><i data-feather="x-square"></i>Batalkan Validasi Berkas Data</a>
                        </span>
                    <?php endif; ?>
                    <spa class="col-lg-4">
<<<<<<< HEAD
                        <a href="<?= base_url('admin/data_sudah_finalisasi'); ?>" class="btn btn-primary"><i data-feather="arrow-left"></i> Kembali</a>
=======
                        <a href="<?= base_url('admin/data_belum_finalisasi'); ?>" class="btn btn-primary"><i data-feather="arrow-left"></i> Kembali</a>
>>>>>>> a4ec211828a96b2f662f82cf47a6aca8ab147643
                    </spa>
                </div>
            </div>


        </div>
    </section>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#judul_biodata').click(function() {
            $("#judul_biodata").removeClass("bg-primary");
            $("#judul_biodata").addClass("col-md-3 bg-info btn");
            $("#judul_sekolah_asal").removeClass("bg-info");
            $("#judul_sekolah_asal").addClass("col-md-3 bg-primary btn");
            $("#judul_prestasi").removeClass("bg-info");
            $("#judul_prestasi").addClass("col-md-3 bg-primary btn");
            $("#judul_data_orang_tua").removeClass("bg-info");
            $("#judul_data_orang_tua").addClass("col-md-3 bg-primary btn");
            $("#biodata").removeClass("visually-hidden");
            $("#data_sekolah").addClass("visually-hidden");
            $("#data_prestasi").addClass("visually-hidden");
            $("#data_ortu").addClass("visually-hidden");

        });
        $('#judul_sekolah_asal').click(function() {
            $("#judul_biodata").removeClass("bg-info");
            $("#judul_biodata").addClass("col-md-3 bg-primary btn");
            $("#judul_prestasi").removeClass("bg-info");
            $("#judul_prestasi").addClass("col-md-3 bg-primary btn");
            $("#judul_sekolah_asal").removeClass("bg-primary");
            $("#judul_sekolah_asal").addClass("col-md-3 bg-info btn");
            $("#judul_data_orang_tua").removeClass("bg-info");
            $("#judul_data_orang_tua").addClass("col-md-3 bg-primary btn");
            $("#biodata").addClass("visually-hidden");
            $("#data_sekolah").removeClass("visually-hidden");
            $("#data_prestasi").addClass("visually-hidden");
            $("#data_ortu").addClass("visually-hidden");
        });
        $('#judul_prestasi').click(function() {
            $("#judul_biodata").removeClass("bg-info");
            $("#judul_biodata").addClass("col-md-3 bg-primary btn");
            $("#judul_sekolah_asal").removeClass("bg-info");
            $("#judul_sekolah_asal").addClass("col-md-3 bg-primary btn");
            $("#judul_prestasi").removeClass("bg-primary");
            $("#judul_prestasi").addClass("col-md-3 bg-info btn");
            $("#judul_data_orang_tua").removeClass("bg-info");
            $("#judul_data_orang_tua").addClass("col-md-3 bg-primary btn");
            $("#biodata").addClass("visually-hidden");
            $("#data_sekolah").addClass("visually-hidden");
            $("#data_prestasi").removeClass("visually-hidden");
            $("#data_ortu").addClass("visually-hidden");
        });
        $('#judul_data_orang_tua').click(function() {
            $("#judul_biodata").removeClass("bg-info");
            $("#judul_biodata").addClass("col-md-3 bg-primary btn");
            $("#judul_data_orang_tua").removeClass("bg-primary");
            $("#judul_data_orang_tua").addClass("col-md-3 bg-info btn");
            $("#judul_sekolah_asal").removeClass("bg-info");
            $("#judul_sekolah_asal").addClass("col-md-3 bg-primary btn");
            $("#judul_prestasi").removeClass("bg-info");
            $("#judul_prestasi").addClass("col-md-3 bg-primary btn");
            $("#biodata").addClass("visually-hidden");
            $("#data_sekolah").addClass("visually-hidden");
            $("#data_prestasi").addClass("visually-hidden");
            $("#data_ortu").removeClass("visually-hidden");
        });
    });
</script>

<script>
    document.foo.submit();
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> a4ec211828a96b2f662f82cf47a6aca8ab147643
