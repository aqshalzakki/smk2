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
                            <a href="<?= base_url('admin/detail_barang/' . $barang['kode_inventaris']) . '/' . $barang['id_jenis']; ?>" class="badge badge-primary">Detail</a>
                            <a href="<?= base_url('admin/edit_barang/' . $barang['kode_inventaris']); ?>" class="badge badge-success">Edit</a>
                            <a href="<?= base_url('admin/hapus_barang/' . $barang['kode_inventaris']); ?>" class="badge badge-danger">Hapus</a>
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