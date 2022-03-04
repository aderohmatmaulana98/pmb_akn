<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

	<div class="card shadow">
		<div>
			<a href="#" class="btn btn-primary m-4">Cetak</a>
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
	</div>
</div>
</div>