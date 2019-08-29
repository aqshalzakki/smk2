
	<!-- Begin Page Content -->
	<div class="container-fluid">

        <!-- breadcrum Barang -->
        <ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="<?= base_url(''); ?>"> Home </a>
                <span>/</span>
                <a href="<?= base_url('admin/inventaris'); ?>">
                    <span> Inventaris </span>
                </a>
			</li>
		</ol>

		<!-- Content -->

		<h1>
			Data inventaris : 
		</h1>

		<div>
            <table id="td_barang" class="table table-hover table-striped table-bordered">
                <th>No</th>
                <th>Nama</th>
                <th>Kondisi</th>
                <th>Jenis</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah</th>

                <?php 

                    $no = 1;
                    foreach ($inventaris as $barang) : 
                ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $barang['username']; ?></td>
                        <td><?= $barang['nama_petugas']; ?></td>
                        <td><?= $barang['id_level']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail">
                                    <i class="fas fa-fw fa-info-circle"></i>
                                </a>
                            </div>
                        
                                <a href="#" class="btn btn-warning text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ubah">
                                    <i class="fas fa-fw fa-edit"></i>
                            
                                </a>
                                <a href="#" class="btn btn-danger text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus">
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