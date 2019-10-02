<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- breadcrum Barang -->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="<?= base_url(''); ?>"> Home </a>
			<span>/</span>
			<a href="<?= base_url('admin/pengembalian'); ?>">
				<span> Pengembalian barang </span>
			</a>
		</li>
	</ol>

	<!-- Content -->

	<h1>
		Konfirmasi Pengembalian barang : 
	</h1>
	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<?= $this->session->flashdata('message'); ?>
			<?php if ($data) : ?>
				<table class="mt-3 text-center table table-bordered table-hovered table-stripped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama pegawai</th>
							<th>Nama Barang</th>
							<th>Jumlah barang</th>
							<th>Tanggal pinjam</th>
							<th>Tanggal kembali</th>
							<th>Status</th>
							<th>Konfirmasi</th>
						</tr>
					</thead>

					<tbody>
						<?php $i = 0;
							foreach ($data as $pengembalian) : ?>
							<tr>
								<td><?= ++$i; ?></td>
								<td><?= $pengembalian['nama_pegawai']; ?></td>
								<td><?= $pengembalian['nama']; ?></td>
								<td><?= $pengembalian['jumlah']; ?></td>
								<td><?= date('d F Y', $pengembalian['tanggal_pinjam']); ?></td>
								<td><?= cek_tgl_pengembalian($pengembalian['tanggal_kembali']); ?></td>
								<td><?= $pengembalian['status_peminjaman'] ?></td>
								<td>
									<!-- JIKA STATUSNYA MASIH DIPINJAM  -->
									<?php if ($pengembalian['status_peminjaman'] == 'DIPINJAM') : ?>
										<div class="btn-group">
											<a href="<?= base_url('admin/konfirmasi_pengembalian/' . $pengembalian['id_peminjaman']); ?>" class="btn btn-success text-white" data-toggle="tooltip" data-placement="bottom" title="Konfirmasi?" data-original-title="Konfirmasi">
												<i class="fas fa-fw fa-check"></i>
											</a>
										</div>
									<?php else : ?>
										<div>
											<p>Sudah dikonfirmasi</p>
										</div>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<p class="text-danger small">
					Note : klik tombol konfirmasi/ceklis jika barang yang dipinjam sudah dikembalikan.
				</p>

			<?php else : ?>
				<h5 class="mt-5"><i>Tidak ada data!</i></h5>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->