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

    <div class="btn pull-right">
        <a data-toggle="modal" data-target="#tambahModal" class="btn btn-primary" href="#" class="btn btn-primary right">
            <span>
                <i class="fas fa-plus"> </i>
                Tambah Data
            </span>
        </a>
    </div>

    <div class="row">
        <div class="col-md-9">
            <table id="td_barang" class="table table-hover table-striped table-bordered text-center">
                <tr>
                    <th>No</th>
                    <th>Nama barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>

                <?php $i = 0;
                foreach ($inventaris as $barang) : ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $barang['nama']; ?></td>
                        <td><?= $barang['jumlah']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/detail_barang/' . $barang['kode_inventaris']) . '/' . $barang['id_jenis']; ?>" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail">
                                    <i class="fas fa-fw fa-info-circle"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/edit_barang/' . $barang['kode_inventaris']); ?>" class="btn btn-warning text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ubah">
                                    <i class="fas fa-fw fa-edit"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="<?= base_url('admin/hapus_barang/' . $barang['kode_inventaris']); ?>" class="btn btn-danger text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->