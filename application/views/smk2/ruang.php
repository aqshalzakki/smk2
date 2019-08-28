
	<!-- Begin Page Content -->
	<div class="container-fluid">

        <!-- breadcrum Ruang -->
        <ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="<?= base_url(''); ?>"> Home</a>
                <span>/</span>
                <span> Inventaris </span>
                <span>/</span>
                <span> Ruang </span>
			</li>
		</ol>

		<!-- Content -->

		<h1>
			Inventaris : Ruang
		</h1>

		<div>

			<div class="text-right">
				<a href="#" data-toggle="modal" data-target="#ruangModal" class="btn btn-primary text-white">
					<i class="fas fa-fw fa-plus"></i>
                    <b>Tambah Data</b>
				</a>
			</div>
		<br>
            <table id="tb_ruang" class="table table-hover table-striped table-bordered">
                <th>No</th>
                <th>Nama Ruang</th>
                <th>Kode Ruang</th>
                <th>Keterangan</th>
                <th>Action</th>
				
                <?php 

                    $no = 1;
                    foreach ($data_ruang as $dt) : 
                ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dt->nama_ruang; ?></td>
                        <td><?= $dt->kode_ruang; ?></td>
                        <td><?= $dt->keterangan; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="Detail" data-original-title="Detail">
                                    <i class="fas fa-fw fa-info-circle"></i>
                                </a>
                            </div>
                        
                                <a href="#" class="btn btn-warning text-white" data-toggle="tooltip" data-placement="bottom" title="Ubah" data-original-title="Ubah">
                                    <i class="fas fa-fw fa-edit"></i>
                            
                                </a>
                                <a href="#" class="btn btn-danger text-white" data-toggle="tooltip" data-placement="bottom" title="Hapus" data-original-title="Hapus">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                
            </table>
        </div>

	</div>
	<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content -->

      <!-- Ruang Modal-->
        <div class="modal fade" id="ruangModal" tabindex="-1" role="dialog" aria-labelledby="ruangModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ruangModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="<?= base_url('auth/tambah'); ?>" method="post">
                            <div class="form-group">
                                <label for="namaRuang">Nama Ruang</label>
                                <input type="text" class="form-control" id="namaRuang" name="namaRuang">
                            </div>
                            <div class="form-group">
                                <label for="kodeRuang">Kode Ruang</label>
                                <input type="text" class="form-control" id="kodeRuang" name="kodeRuang">
                            </div>
                            <div class="form-group">
                                <label for="ketRuang">Keterangan</label>
                                <input type="text" class="form-control" id="ketRuang" name="ketRuang">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>