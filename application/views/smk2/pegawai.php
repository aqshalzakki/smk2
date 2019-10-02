
	<!-- Begin Page Content -->
	<div class="container-fluid">

        <!-- breadcrum Petugas -->
        <ol class="breadcrumb">
			<li class="breadcrumb-item">
                <a href="<?= base_url(); ?>"> Home </a>
                    <span>/</span>
                <a href="<?= base_url('admin/pegawai'); ?>">
                    <span> Pegawai </span>
                </a>
			</li>
		</ol>

		<!-- Content -->

		<h1>
			Data Pegawai
		</h1>

        <div>
        <!-- MESSAGE -->
        <?= $this->session->flashdata('message'); ?>
            

            <table id="tb_pegawai" class="table table-hover table-striped table-bordered">
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                
                    <!-- Jika levelnya ADMIN maka kolom ini AKAN ditampilkan -->
                    <?php if ($level == 'admin') : ?>

                <th>Aksi</th>
                
                    <?php endif; ?>

                </tr>

                <?php $i = 0;
                foreach ($pegawai as $p) : ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $p['nama_pegawai']; ?></td>
                        <td><?= $p['username']; ?></td>
                        <td><?= $p['id_level']; ?></td>

                        <!-- Jika levelnya ADMIN maka kolom ini AKAN ditampilkan -->
                        <?php if ($level == 'admin') : ?>

                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('admin/detail_pegawai/' . $p['nip']); ?>" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail">
                                        <i class="fas fa-fw fa-info-circle"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger text-white hapusModal" data-kode="<?= $p['id_pegawai']; ?>" data-toggle="modal" data-target="#hapusModal">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </a>
                                </div>
                            </td>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

	</div>
	<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content -->