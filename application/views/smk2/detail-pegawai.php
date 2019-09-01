<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- breadcrum Pegawai -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= base_url(''); ?>"> Home </a>
                <span>/</span>
            <a href="<?= base_url('admin/pegawai'); ?>">
                <span> Pegawai </span>
            </a>
                <span>/</span>
            <a href="<?= base_url('admin/detail_pegawai/' . $pegawai['id_pegawai']); ?>">
                <span> Detail Pegawai </span>
            </a>
        </li>
    </ol>

    <!-- Content -->
    <h2 class="my-4">Detail Pegawai</h2>

    <div class="row">
        <div class="col-sm-10 col-lg-6 col-md-8">
            <div class="card">
                <div class="card-header">
                    <img src="<?= base_url('vendor/img/' . $user['gambar']); ?>" class="card-img" style="height: 50%; width: 50%;">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">NIP : <b><?= $pegawai['nip']; ?></b></li>
                    <li class="list-group-item">Nama Pegawai : <b><?= $pegawai['nama_pegawai']; ?></b></li>
                    <li class="list-group-item">Username : <b><?= $pegawai['username']; ?></b></li>
                    <li class="list-group-item">Alamat : <b><?= $pegawai['alamat']; ?></b></li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->