<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- breadcrum Barang -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= base_url(); ?>"> Home </a>
            <span>/</span>
            <a href="<?= base_url(strtolower($this->session->userdata('user')['nama_level']) . '/inventaris'); ?>">
                <span> Inventaris </span>
            </a>
        </li>
    </ol>

    <!-- Content -->

    <h1 class="my-4">
        Data inventaris :
    </h1>


    <div class="row">
        <div class="col-md-9">

            <!-- MESSAGE -->
            <?= $this->session->flashdata('message'); ?>
            
            <!-- Jika levelnya ADMIN maka content ini AKAN ditampilkan -->

            <?php if ($level == 'admin') : ?>
                <div class="btn pull-right">
                    <a data-toggle="modal" data-target="#tambahModal" href="#" class="btn btn-primary right tambahModal">
                        <span>
                            <i class="fas fa-plus"> </i>
                            Tambah Data
                        </span>
                    </a>
                </div>
                
                <!-- GENERATE LAPORAN INVENTARIS  -->
                <div class="btn float-right">
                    <a href="<?= base_url('admin/generate/inventaris'); ?>" class="btn btn-success right">
                        <span>
                            <i class="fas fa-file-archive"> </i>
                            Generate laporan
                        </span>
                    </a>
                </div>
            <?php endif; ?>

            <table id="td_barang" class="table table-hover table-striped table-bordered text-center">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama barang</th>
                    <th>Jumlah</th>

                    <!-- Jika levelnya ADMIN maka kolom ini AKAN ditampilkan -->
                    <?php if ($level == 'admin') : ?>

                        <th>Aksi</th>

                    <?php endif; ?>
                </tr>

                <?php $i = 0;
                foreach ($inventaris as $barang) : ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $barang['kode_inventaris']; ?></td>
                        <td><?= $barang['nama']; ?></td>
                        <td><?= $barang['jumlah']; ?></td>

                        <!-- Jika levelnya ADMIN maka kolom ini AKAN ditampilkan -->
                        <?php if ($level == 'admin') : ?>

                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('admin/detail_barang/' . $barang['kode_inventaris']) . '/' . $barang['id_jenis']; ?>" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detail">
                                        <i class="fas fa-fw fa-info-circle"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="<?= base_url('admin/edit_barang/') ?> " class="btn btn-warning text-white editModal" data-toggle="modal" data-target="#tambahModal" data-id="<?= $barang['kode_inventaris']; ?>" data-placement="bottom" title="" data-original-title="Ubah">
                                        <i class="fas fa-fw fa-edit"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger text-white hapusModal" data-kode="<?= $barang['kode_inventaris']; ?>" data-toggle="modal" data-target="#hapusModal">
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content