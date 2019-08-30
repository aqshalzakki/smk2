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
            <span>/</span>
            <a href="<?= base_url('admin/detail_barang/' . $barang['kode_inventaris']); ?>">
                <span> Detail Barang </span>
            </a>
        </li>
    </ol>

    <!-- Content -->
    <h2 class="my-4">Detail untuk barang : <?= $barang['nama']; ?></h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    <?= $jenis['nama_jenis']; ?>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->