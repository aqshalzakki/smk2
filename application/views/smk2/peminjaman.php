<?php $nama_level = strtolower($this->session->userdata('user')['nama_level']); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- breadcrum Barang -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= base_url($nama_level); ?>"> Home </a>
            <span>/</span>
            <a href="<?= base_url($nama_level . '/peminjaman'); ?>">
                <span> Peminjaman barang </span>
            </a>
        </li>
    </ol>

    <!-- Content -->

    <h1>
        Data Peminjaman barang :
    </h1>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->