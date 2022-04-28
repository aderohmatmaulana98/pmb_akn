<div class="container">
    <section>
        <div class="container-fluid">
            <?= $this->session->flashdata('message');  ?>
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-5">FORMULIR PENDAFTARAN</h3>
                    <div class="row text-center mb-5 border-white border-2" id="judul">
                        <?php if ($user['isi_biodata'] == 0) : ?>
                            <div class="col-md-3 bg-primary btn" id="judul1">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">BIODATA </h6>
                            </div>
                        <?php else : ?>
                            <div class="col-md-3 bg-success btn" id="judul1">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">BIODATA <i data-feather="check"></i></h6>
                            </div>
                        <?php endif; ?>
                        <?php if ($user['isi_biodata'] == 1 && $user['isi_sekolah_asal'] == 0) : ?>
                            <div class="col-md-3 bg-primary btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">SEKOLAH ASAL</h6>
                            </div>
                        <?php elseif ($user['isi_biodata'] == 0 && $user['isi_sekolah_asal'] == 0) : ?>
                            <div class="col-md-3 bg-danger btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">SEKOLAH ASAL</h6>
                            </div>
                        <?php else : ?>
                            <div class="col-md-3 bg-success btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">SEKOLAH ASAL <i data-feather="check"></i></h6>
                            </div>
                        <?php endif; ?>
                        <?php if ($user['isi_biodata'] == 1 && $user['isi_sekolah_asal'] == 1 && $user['isi_prestasi'] == 0) : ?>
                            <div class="col-md-3 bg-primary btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">PRESTASI</h6>
                            </div>
                        <?php elseif ($user['isi_biodata'] == 1 && $user['isi_sekolah_asal'] == 1 && $user['isi_prestasi'] == 1) : ?>
                            <div class="col-md-3 bg-success btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">PRESTASI <i data-feather="check"></i></h6>
                            </div>
                        <?php else : ?>
                            <div class="col-md-3 bg-danger btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">PRESTASI</h6>
                            </div>

                        <?php endif; ?>
                        <?php if ($user['isi_biodata'] == 1 && $user['isi_sekolah_asal'] == 1 && $user['isi_prestasi'] == 1 && $user['isi_data_ortu'] == 0) : ?>
                            <div class="col-md-3 bg-primary btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">DATA ORANG TUA</h6>
                            </div>
                        <?php elseif ($user['isi_biodata'] == 1 && $user['isi_sekolah_asal'] == 1 && $user['isi_prestasi'] == 1 && $user['isi_data_ortu'] == 1) : ?>
                            <div class="col-md-3 bg-success btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">DATA ORANG TUA <i data-feather="check"></i></h6>
                            </div>
                        <?php else : ?>
                            <div class="col-md-3 bg-danger btn">
                                <h6 class="card-subtitle text-white btn btn-lg col-lg">DATA ORANG TUA</h6>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($user['isi_biodata'] == 0 && $user['isi_sekolah_asal'] == 0) : ?>
                        <div class="" id="biodata">
                        <?php else : ?>
                            <div class="visually-hidden" id="biodata">
                            <?php endif; ?>
                            <form action="<?= base_url('user/aksi_tambah_formulir') ?>" method="POST" enctype="multipart/form-data">
                                <div class=" mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jalur_seleksi" class="form-label">Jalur Seleksi</label>
                                    <input type="text" class="form-control" id="jalur_seleksi" name="jalur_seleksi" value="AKNSBY (Kemitraan Pemprov DIY)" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="jalur_seleksi" class="form-label">Prodi Pilihan</label>
                                    <select class="form-select" id="prodi" name="prodi" required>
                                        <option value="" selected disabled>Pilih Prodi</option>
                                        <?php foreach ($prodi as $p) : ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['nama_prodi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ttl" class="form-label">Tempat, Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                        </div>
                                        <small>Sesuaikan dengan ijazah</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi_tempat_lahir" class="form-label">Provinsi Tempat Lahir</label>
                                    <select class="form-select" id="provinsi_tempat_lahir" name="provinsi_tempat_lahir" required>
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $prov_lahir) : ?>
                                            <option value="<?= $prov_lahir['nama_provinsi'] ?>"><?= $prov_lahir['nama_provinsi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $user['nik']; ?>" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="1">Laki - Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                                    <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                                        <option value="" selected disabled>Pilih Status Pernikahan</option>
                                        <option value="Sudah Menikah">Sudah Menikah</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <select name="agama" id="agama" class="form-control" required>
                                        <option value="" selected disabled>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No Hp / Whatsapp</label>
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                                    <small>Masukan dengan awalan kode 62xxxx (format internasional)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" class="form-control" id="alamat_lengkap" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="provinsi_tempat_tinggal" class="form-label">Provinsi Tempat Tinggal</label>
                                    <select name="provinsi" class="form-control" id="provinsi" required>
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $prov) : ?>
                                            <option value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kabupaten_tempat_tinggal" class="form-label">Kabupaten Tempat Tinggal</label>
                                    <select name="kabupaten" class="form-control" id="kabupaten" required>
                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan_tempat_tinggal" class="form-label">Kecamatan Tempat Tinggal</label>
                                    <select name="kecamatan" class="form-control" id="kecamatan" required>
                                        <option value="" selected disabled>Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos Tempat Tinggal</label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                                    <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload pas foto</label>
                                    <input class="form-control" type="file" id="pas_foto" name="pas_foto" required>
                                    <small>Upload file dengan format PNG/JPG dengan ukuran max 1 MB</small>
                                </div>
                                <button type="submit" onclick="javascript: return confirm('Dengan ini data yang saya isikan adalah benar. ')" class="btn btn-primary">Submit</button>
                            </form>
                            </div>
                            <?php if ($user['isi_biodata'] == 1 && $user['isi_sekolah_asal'] == 0) : ?>
                                <div class="" id="data_sekolah">
                                <?php else : ?>
                                    <div class="visually-hidden" id="data_sekolah">
                                    <?php endif; ?>
                                    <form action="<?= base_url('user/aksi_tambah_sekolah_asal'); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label><br>
                                            <select name="nama_sekolah" class="form-select" id="nama_sekolah" required>
                                                <option value="" selected disabled>Pilih Sekolah</option>
                                                <?php foreach ($sekolah as $s) : ?>
                                                    <option value="<?= $s['nama_sekolah'] ?>"><?= $s['nama_sekolah'] ?></option>
                                                <?php endforeach; ?>
                                                <option value="lainnya">LAINNYA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 visually-hidden" id="nama_sekolah1">
                                            <label for="nama_sekolah1" class="form-label">Masukan Sekolah</label>
                                            <input type="text" class="form-control" id="inputan" name="nama_sekolah1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_sekolah" class="form-label">Jenis Sekolah</label>
                                            <select name="jenis_sekolah" class="form-select" id="jenis_sekolah" required>
                                                <option value="" selected disabled>Pilih Jenis Sekolah</option>
                                                <?php foreach ($status_sekolah as $ss) : ?>
                                                    <option value="<?= $ss['status'] ?>"><?= $ss['status'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="provinsi_asal_sekolah" class="form-label">Provinsi Asal Sekolah</label>
                                            <select name="provinsi_asal_sekolah" class="form-select" id="provinsi_asal_sekolah" required>
                                                <option value="" selected disabled>Pilih Asal Sekolah</option>
                                                <?php foreach ($provinsi as $pr) : ?>
                                                    <option value="<?= $pr['id'] ?>"><?= $pr['nama_provinsi'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_lengkap_sekolah" class="form-label">Alamat Lengkap Sekolah</label>
                                            <textarea name="alamat_lengkap_sekolah" class="form-control" id="alamat_lengkap_sekolah" cols="30" rows="10" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jurusan" class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                                            <select class="form-select" name="status_kelulusan" id="status_kelulusan" required>
                                                <option selected>Pilih status kelulusan</option>
                                                <option value="0">Belum Lulus</option>
                                                <option value="1">Sudah Lulus</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                            <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_ijazah" class="form-label">No Ijazah</label>
                                            <input type="text" class="form-control" id="no_ijazah" name="no_ijazah" required>
                                            <small>Jika belum ada, isi dengan angka 0 atau -</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_ijazah" class="form-label">Tanggal Ijazah</label>
                                            <input type="date" class="form-control" id="tgl_ijazah" name="tgl_ijazah" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_nilai" class="form-label">Data Nilai Ujian Akhir Nasional/EBTANAS</label>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="bhs_indonesia" class="form-label">Bhs Indonesia</label>
                                                    <input type="text" class="form-control" id="bhs_indonesia" name="bhs_indonesia" required>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="bhs_inggris" class="form-label">Bhs Inggris</label>
                                                    <input type="text" class="form-control" id="bhs_inggris" name="bhs_inggris" required>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="matematika" class="form-label">Matematika</label>
                                                    <input type="text" class="form-control" id="matematika" name="matematika" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" onclick="javascript: return confirm('Dengan ini data yang saya isikan adalah benar. ')" class="btn btn-primary">Submit</button>
                                    </form>
                                    </div>
                                    <?php if ($user['isi_sekolah_asal'] == 1 && $user['isi_prestasi'] == 0) : ?>
                                        <div class="" id="data_prestasi">
                                        <?php else : ?>
                                            <div class="visually-hidden" id="data_prestasi">
                                            <?php endif; ?>

                                            <form action="<?= base_url('user/aksi_tambah_prestasi'); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="jenis_kegiatan_lomba" class="form-label">Jenis Kegiatan Lomba</label>
                                                    <input type="text" class="form-control" id="jenis_kegiatan_lomba" name="jenis_kegiatan_lomba" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tingkat_kejuaraan" class="form-label">Tingkat Kejuaraan</label>
                                                    <select class="form-select" id="tingkat_kejuaraan" name="tingkat_kejuaraan">
                                                        <option disabled selected>Pilih Tingkat Kejuaraan</option>
                                                        <option value="Internasional">Internasional</option>
                                                        <option value="Nasional">Nasional</option>
                                                        <option value="Provinsi">Provinsi</option>
                                                        <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="prestasi_juara_ke" class="form-label">Prestasi Juara Ke</label>
                                                    <input type="number" class="form-control" id="prestasi_juara_ke" name="prestasi_juara_ke">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="<?= base_url('user/prestasi_selesai') ?>" onclick="javascript: return confirm('Dengan ini data yang saya isikan adalah benar. ')" class="btn btn-danger">Selesai</a>
                                            </form>
                                            </div>
                                            <?php if ($user['isi_prestasi'] == 1 && $user['isi_data_ortu'] == 0) : ?>
                                                <div class="" id="data_ortu">
                                                <?php else : ?>
                                                    <div class="visually-hidden" id="data_ortu">
                                                    <?php endif; ?>
                                                    <form action="<?= base_url('user/aksi_tambah_data_ortu') ?>" method="POST" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pendidikan_terakhir_ayah" class="form-label">Pendidikan Terakhir Ayah</label>
                                                            <select class="form-select" name="pendidikan_terakhir_ayah" id="pendidikan_terakhir_ayah" required>
                                                                <option selected disabled>Pilih pendidikan terakhir ayah</option>
                                                                <option value="SD">SD</option>
                                                                <option value="SMP">SMP</option>
                                                                <option value="SMA">SMA</option>
                                                                <option value="S1">S1</option>
                                                                <option value="S2">S2</option>
                                                                <option value="S3">S3</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                                            <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                                                            <select class="form-select" id="penghasilan_ayah" name="penghasilan_ayah" required>
                                                                <option selected disabled>Pilih Penghasilan Ayah</option>
                                                                <option value="Kurang dari Rp.500.000">Kurang dari Rp.500.000</option>
                                                                <option value="Rp.1.000.000-Rp.1999.999">Rp.1.000.000-Rp.1999.999</option>
                                                                <option value="Rp.2.000.000-Rp.4999.999">Rp.2.000.000-Rp.4999.999</option>
                                                                <option value="Rp.5.000.000-Rp.20.000.000">Rp.5.000.000-Rp.20.000.000</option>
                                                                <option value="Lebih dari Rp.20.000.000">Lebih dari Rp.20.000.000</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pendidikan_ibu" class="form-label">Pendidikan Terakhir Ibu</label>
                                                            <select class="form-select" name="pendidikan_ibu" id="pendidikan_ibu">
                                                                <option selected disabled>Pilih pendidikan terakhir ibu</option>
                                                                <option value="SD">SD</option>
                                                                <option value="SMP">SMP</option>
                                                                <option value="SMA">SMA</option>
                                                                <option value="S1">S1</option>
                                                                <option value="S2">S2</option>
                                                                <option value="S3">S3</option>
                                                                <option value="Tidak Ada">Tidak Ada</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                                            <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                                                            <select class="form-select" id="penghasilan_ibu" name="penghasilan_ibu" required>
                                                                <option selected disabled>Pilih Penghasilan Ibu</option>
                                                                <option value="Kurang dari Rp.500.000">Kurang dari Rp.500.000</option>
                                                                <option value="Rp.1.000.000-Rp.1999.999">Rp.1.000.000-Rp.1999.999</option>
                                                                <option value="Rp.2.000.000-Rp.4999.999">Rp.2.000.000-Rp.4999.999</option>
                                                                <option value="Rp.5.000.000-Rp.20.000.000">Rp.5.000.000-Rp.20.000.000</option>
                                                                <option value="Lebih dari Rp.20.000.000">Lebih dari Rp.20.000.000</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat_lengkap_ortu" class="form-label">Alamat Lengkap Orang Tua</label>
                                                            <textarea name="alamat_lengkap_ortu" class="form-control" id="alamat_lengkap_ortu" cols="30" rows="10" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="provinsi_asal_orang_tua" class="form-label">Provinsi Asal Orang Tua</label>
                                                            <select name="provinsi_asal_orang_tua" class="form-control" id="provinsi_asal_orang_tua" required>
                                                                <option value="" selected disabled>Pilih Provinsi Asal Orang Tua</option>
                                                                <?php foreach ($provinsi as $prov) : ?>
                                                                    <option value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kabupaten_asal_orang_tua" class="form-label">Kabupaten Asal Orang Tua</label>
                                                            <select name="kabupaten_asal_orang_tua" class="form-control" id="kabupaten_asal_orang_tua" required>
                                                                <option value="" selected disabled>Pilih Kabupaten Asal Orang Tua</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kodepos_alamat_orang_tua" class="form-label">Kodepos Alamat Orang Tua</label>
                                                            <input type="text" class="form-control" id="kodepos_alamat_orang_tua" name="kodepos_alamat_orang_tua" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="no_telp_orang_tua" class="form-label">No Telp Orang Tua</label>
                                                            <input type="text" class="form-control" id="no_telp_orang_tua" name="no_telp_orang_tua" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nama_wali" class="form-label">Nama Wali (Jika Ada)</label>
                                                            <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat_lengkap_wali" class="form-label">Alamat Lengkap Wali</label>
                                                            <textarea name="alamat_lengkap_wali" class="form-control" id="alamat_lengkap_wali" cols="30" rows="10"></textarea>
                                                        </div>
                                                        <button type="submit" onclick="javascript: return confirm('Dengan ini data yang saya isikan adalah benar.')" class="btn btn-primary">Submit</button>
                                                    </form>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
    </section>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/kabupaten') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kabupaten').html(response);
                }
            });
        });

        $('#kabupaten').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/kecamatan') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kecamatan').html(response);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#provinsi_asal_orang_tua').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('user/kabupaten_asal_orang_tua') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kabupaten_asal_orang_tua').html(response);
                }
            });
        });
    });
</script>
<script>
    $('#nama_sekolah').select2({
        placeholder: "Pilih Sekolah"
    });
</script>
<script>
    $('#nama_sekolah').change(function() {
        let nama_sekolah = $(this).val();

        if (nama_sekolah == 'lainnya') {
            let muncul = document.getElementById('nama_sekolah1');
            muncul.className = 'mb-3';
            let inputan = document.getElementsByTagName('input')[10];
            inputan.setAttribute("required", true);
            console.log(inputan);
        } else {
            let muncul = document.getElementById('nama_sekolah1');
            muncul.className = 'visually-hidden';
            let inputan = document.getElementsByTagName('input')[10];
            inputan.removeAttribute("required");
        }
    });
</script>
<!-- <script>
    function biodata() {
        let data_diri = document.getElementById('biodata');
        let judul = document.getElementById('judul1');
        judul.className = 'col-md-3 bg-primary'
    }
</script> -->