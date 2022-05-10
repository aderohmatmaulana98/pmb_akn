<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?php echo($title) ?></h1>

	<div class="card shadow">
		<div>
		<form action="<?= base_url('admin/cetak_data_calon_mhs') ?>" method="POST">
		<div class="col-lg-6 p-3">
			<div class="input-group mb-3">
				<select name="th_ajaran" id="th_ajaran" class="form-control" required>
					<option value="" selected disabled>Pilih Tahun Ajaran</option>
					<?php foreach ($tahun_ajaran as $th) : ?>
						<option value="<?= $th['id']; ?>"><?= $th['tahun_ajaran']; ?></option>
					<?php endforeach; ?>
				</select>
				<select name="gelombang" id="gelombang" class="form-control" required>
					<option value="" selected disabled>Pilih Gelombang</option>
					<?php foreach ($jadwal as $jd) : ?>
						<option value="<?= $jd['id']; ?>"><?= $jd['gelombang']; ?></option>
					<?php endforeach; ?>
				</select>
				<button type="submit" class="btn btn-primary"><i data-feather="printer" width="20"></i> Cetak</button>
			</div>
		</div>			
        </form>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover" id="example" class="display">
					<thead>
						<tr>
							<th scope="col">
								#
							</th>
							<th scope="col">No Pendaftaran</th>
							<th scope="col">No Induk Kependudukan</th>
							<th scope="col">Nama Lengkap</th>
							<th scope="col">Prodi yang dipilih</th>
							<th scope="col">Tahun Ajaran</th>
							<th scope="col">Nilai Praktek</th>
							<th scope="col">Nilai Wawancara</th>
							<th scope="col">Skor Nilai</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($data_calon_mahasiswa as $dcm) : ?>
							<tr>
								<th scope="row"><?= $i ?></th>
								<td><?= $dcm['no_pendaftaran'] ?></td>
								<td><?= $dcm['nik'] ?></td>
								<td><?= $dcm['nama_lengkap'] ?></td>
								<td><?= $dcm['nama_prodi'] ?></td>
								<td><?= $dcm['tahun_ajaran'] ?></td>
								<td>
									<?php if ($dcm['praktek'] == null) : ?>
										Belum dinilai
									<?php else : ?>
										<?= $dcm['praktek'] ?>
									<?php endif; ?>
								</td>
								<td>
									<?php if ($dcm['wawancara'] == null) : ?>
										Belum dinilai
									<?php else : ?>
										<?= $dcm['wawancara'] ?>
									<?php endif; ?>
								</td>
								<td>
									<?php if ($dcm['skor'] == null) : ?>
										Belum dinilai
									<?php else : ?>
										<?= $dcm['skor'] ?>
									<?php endif; ?>
								</td>
							</tr>
						<?php $i++;
						endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="text-center mb-5">
                    <a href="<?= base_url('admin/data_calon_mahasiswa') ?>" class="btn btn-success"><i data-feather="arrow-left" width="20" class="mb-1"></i> Kembali</a>
            </div>
	</div>
</div>
</div>