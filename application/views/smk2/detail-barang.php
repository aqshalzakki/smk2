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
    <h2 class="my-4">Detail barang</h2>

    <div class="row">
        <div class="col-sm-10 col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header">
                    Jenis barang : <b><?= $jenis['nama_jenis']; ?> </b>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nama barang : <b><?= $barang['nama']; ?></b></li>
                    <li class="list-group-item">Kode Inventaris : <b><?= $barang['kode_inventaris']; ?></b></li>
                    <li class="list-group-item">Kondisi : <b><?= $barang['kondisi']; ?></b></li>
                    <li class="list-group-item">Jumlah : <b><?= $barang['jumlah']; ?> pcs</b></li>
                    <li class="list-group-item">Keterangan : <b><?= $barang['keterangan']; ?></b></li>
                    <li class="list-group-item">Tanggal Register: <b><?= date('d F Y', $barang['tanggal_register'] ); ?></b></li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->